<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecapController extends Controller
{
    // Recap for Staff
    public function staffRecap(Request $request)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $user_id = $request->user()->id;
        $year = date('Y');

        // Total Kehadiran
        $totalAttendance = Attendance::where('user_id', $user_id)
            ->whereYear('date', $year)
            ->count();

        // Total Permission
        $totalLeave = Permission::where('user_id', $user_id)
            ->whereYear('leave_date', $year)
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

    // Recap for Admin Dashboard
    public function adminRecap(Request $request)
    {
        $today = date('Y-m-d');

        // Total Kehadiran hari ini
        $totalAttendance = Attendance::where('date', $today)
            ->count();

        // Total Permission hari ini
        $totalPermissions = Permission::where('leave_date', $today)
            ->count();

        // Total Permission berdasarkan status ajuan dari seluruh ajuan
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
