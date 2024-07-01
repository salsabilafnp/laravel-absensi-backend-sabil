<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    // check in
    public function checkIn(Request $request)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $user_id = $request->user()->id;
        $date = date('Y-m-d');

        // Sudah check in hari ini?
        $existingCheckIn = Attendance::where('user_id', $user_id)
            ->where('date', $date)
            ->whereNotNull('checkIn_time')
            ->first();

        if ($existingCheckIn) {
            return response()->json([
                'message' => 'You have already checked in today.',
            ], 400);
        }

        $attendance = new Attendance;
        $attendance->user_id = $user_id;
        $attendance->date = $date;
        $attendance->checkIn_time = date('H:i:s');
        $attendance->latlon_in = $request->latitude . "," . $request->longitude;
        $attendance->save();

        return response()->json([
            'message' => 'Check in successfully',
            'attendance' => $attendance,
        ], 200);
    }

    // check out
    public function checkOut(Request $request)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $attendance = Attendance::where('user_id', $request->user()->id)
            ->where('date', date('Y-m-d'))
            ->first();

        if (!$attendance) {
            return response()->json([
                'message' => 'You have not checked in yet',
            ], 400);
        } else if ($attendance->checkOut_time) {
            return response()->json([
                'message' => 'You have checked out',
            ], 400);
        } else {
            $attendance->checkOut_time = date('H:i:s');
            $attendance->latlon_out = $request->latitude . "," . $request->longitude;
            $attendance->save();

            return response()->json([
                'message' => 'Check out successfully',
                'attendance' => $attendance,
            ], 200);
        }
    }

    // show detail attendance
    public function show($id)
    {
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return response()->json([
                'message' => 'Attendance not found.',
            ], 404);
        }

        return response()->json(['attendance' => $attendance], 200);
    }

    // history for an user
    public function history()
    {
        $attendances = Attendance::where('user_id', auth()->user()->id)
            ->orderBy('date', 'desc')
            ->take(14)
            ->get();

        return response()->json(['attendances' => $attendances], 200);
    }

    // attendances history from all users
    public function allHistory()
    {
        $attendances = Attendance::orderBy('date', 'desc')->take(20)->get();

        if($attendances->isEmpty()){
            return response()->json(['message' => 'No records'], 404);
        }

        return response()->json(['attendances' => $attendances], 200);
    }

    // today attendance
    public function today()
    {
        $attendance = Attendance::where('user_id', auth()->user()->id)
            ->where('date', date('Y-m-d'))
            ->first();

        return response()->json(['attendance' => $attendance], 200);
    }

    // filter: by user_id or month or year
    public function filter(Request $request)
    {
        $query = Attendance::query();

        if ($request->has('user_id')) {
            $query->where('user_id', $request->user()->id);
        }

        if ($request->has('month')) {
            $query->whereMonth('created_at', $request->month);
        }

        if ($request->has('year')) {
            $query->whereYear('created_at', $request->year);
        }

        $attendances = $query->get();

        return response()->json($attendances);
    }
}
