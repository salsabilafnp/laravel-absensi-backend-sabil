<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // check in
    public function checkIn(Request $request)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $attendance = new Attendance;
        $attendance->user_id = auth()->user()->id;
        $attendance->date = date('Y-m-d');
        $attendance->time_in = date('H:i:s');
        $attendance->latlon_in = $request->latitude . "," . $request->longitude;
        $attendance->save();

        return response([
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
            return response([
                'message' => 'You have not checked in yet',
            ], 400);
        } else if ($attendance->time_out) {
            return response([
                'message' => 'You have checked out',
            ], 400);
        } else {
            $attendance->time_out = date('H:i:s');
            $attendance->latlon_out = $request->latitude . "," . $request->longitude;
            $attendance->save();

            return response([
                'message' => 'Check out successfully',
                'attendance' => $attendance,
            ], 200);
        }
    }

    // checkedIn?
    public function isCheckedIn(Request $request)
    {
        $attendance = Attendance::where('user_id', $request->user()->id)
            ->where('date', date('Y-m-d'))
            ->first();

        return response([
            'checkedIn' => $attendance ? true : false,
            'message' => 'You have checked in',
        ], 200);
    }
}
