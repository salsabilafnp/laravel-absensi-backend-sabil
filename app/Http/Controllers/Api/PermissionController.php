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
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'reason' => 'required',
        ]);

        $permission = new Permission();
        $permission->user_id = auth()->user()->id;
        $permission->type = $request->type;
        $permission->start_date = $request->start_date;
        $permission->end_date = $request->end_date;
        $permission->reason = $request->reason;
        $permission->status = 'pending';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/permissions', $image->hashName());
            $permission->image = $image->hashName();
        }

        $permission->save();

        return response(['message' => 'Permission created successfully'], 201);
    }
}
