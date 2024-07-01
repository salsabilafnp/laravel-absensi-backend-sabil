<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Permission;
use Illuminate\Http\Request;

class RecapController extends Controller
{
    // Recap for Staff
    public function staffRecap(Request $request)
    {
        $user_id = $request->user()->id;
        $year = date('Y');

        // Total Kehadiran
        $totalAttendance = Attendance::where('user_id', $user_id)
            ->whereYear('date', $year)
            ->count();

        // Total Cuti, Sakit, WFH
        $totalLeave = Permission::where('user_id', $user_id)
            ->whereYear('leave_date', $year)
            ->whereIn('permit_type', ['annual', 'sick', 'wfh'])
            ->count();

        // Total Cuti
        $totalAnnualLeave = Permission::where('user_id', $user_id)
            ->whereYear('leave_date', $year)
            ->where('permit_type', 'annual')
            ->count();

        // Total Sakit
        $totalSickLeave = Permission::where('user_id', $user_id)
            ->whereYear('leave_date', $year)
            ->where('permit_type', 'sick')
            ->count();

        // Total WFH
        $totalWFH = Permission::where('user_id', $user_id)
            ->whereYear('leave_date', $year)
            ->where('permit_type', 'wfh')
            ->count();

        return response()->json([
            'totalAttendance' => $totalAttendance,
            'totalLeave' => $totalLeave,
            'totalAnnualLeave' => $totalAnnualLeave,
            'totalSickLeave' => $totalSickLeave,
            'totalWFH' => $totalWFH,
        ]);
    }

    // recap for dashboard admin
    public function adminRecap(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-d'));
        $endDate = $request->input('end_date', date('Y-m-d'));

        // Total Kehadiran dalam periode tertentu
        $totalAttendance = Attendance::whereBetween('date', [$startDate, $endDate])
            ->count();

        // Total Ajuan Cuti dalam periode tertentu
        $totalPermissions = Permission::whereBetween('leave_date', [$startDate, $endDate])
            ->count();

        // Total Ajuan Cuti berdasarkan status
        $totalPending = Permission::where('status', 'pending')
            ->count();

        $totalApproved = Permission::where('status', 'approved')
            ->count();

        $totalRejected = Permission::where('status', 'rejected')
            ->count();

        return response()->json([
            'totalAttendance' => $totalAttendance,
            'totalPermissions' => $totalPermissions,
            'totalPending' => $totalPending,
            'totalApproved' => $totalApproved,
            'totalRejected' => $totalRejected,
        ]);
    }
}
