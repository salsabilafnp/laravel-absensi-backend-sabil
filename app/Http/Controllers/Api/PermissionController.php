<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    // store (create API)
    public function store(Request $request)
    {
        $request->validate([
            'permit_type' => 'required',
            'leave_date' => 'required',
            'duration' => 'required',
            'reason' => 'required',
        ]);

        $permission = new Permission();
        $permission->user_id = auth()->user()->id;
        $permission->permit_type = $request->permit_type;
        $permission->leave_date = $request->leave_date;
        $permission->duration = $request->duration;
        $permission->reason = $request->reason;
        $permission->status = 'pending';

        if ($request->hasFile('file_url')) {
            $file_url = $request->file('file_url');
            $file_url->storeAs('public/permissions', $file_url->hashName());
            $permission->file_url = $file_url->hashName();
        }

        $permission->save();

        return response(['message' => 'Permission created successfully'], 201);
    }
}
