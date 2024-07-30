<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PermissionController extends Controller
{
    // index (history for user API)
    public function index()
    {
        $permissions = Permission::with('user')
            ->where('user_id', auth()->user()->id)
            ->orderBy('leave_date', 'desc')
            ->take(14)
            ->get();

        if ($permissions->isEmpty()) {
            return response()->json(['message' => 'No records'], 404);
        }

        return response()->json(['permissions' => $permissions], 200);
    }

    // history all permissions
    public function allHistory()
    {
        $permissions = Permission::with('user')->get();

        if ($permissions->isEmpty()) {
            return response()->json(['message' => 'No records'], 404);
        }

        return response()->json(['permissions' => $permissions], 200);
    }

    // store (create API)
    public function store(Request $request)
    {
        $request->validate([
            'permit_type' => 'required',
            'leave_date' => 'required',
            'duration' => 'required',
            'reason' => 'required',
            'file_url' => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:2048',
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
            $path = $file_url->storeAs('public/permissions', $file_url->hashName());
            $permission->file_url = basename($path);
        }

        $permission->save();

        $permission->load('user');

        return response()->json(['message' => 'Permission created successfully', 'permission' => $permission], 201);
    }

    // update (update API)
    public function update(Request $request, $id)
    {
        $request->validate([
            'permit_type' => 'required|in:annual,sick,wfh',
            'leave_date' => 'required|date',
            'duration' => 'required|integer',
            'reason' => 'required|string',
        ]);

        $permission = Permission::find($id);

        if (!$permission || $permission->user_id != auth()->user()->id) {
            return response()->json(['message' => 'Permission not found'], 404);
        }

        $permission->permit_type = $request->permit_type;
        $permission->leave_date = $request->leave_date;
        $permission->duration = $request->duration;
        $permission->reason = $request->reason;

        if ($request->hasFile('file_url')) {
            // Hapus file lama jika ada
            if ($permission->file_url) {
                Storage::delete('public/permissions/' . $permission->file_url);
            }
        
            $file_url = $request->file('file_url');
            $path = $file_url->storeAs('public/permissions', $file_url->hashName());
            $permission->file_url = basename($path);
        }

        $permission->save();
        $permission->load('user');

        return response()->json(['message' => 'Permission updated successfully', 'permission' => $permission], 200);
    }

    // destroy (delete API)
    public function destroy($id)
    {
        $permission = Permission::find($id);

        if ($permission->user_id != auth()->user()->id) {
            return response()->json(['message' => 'Permission not found'], 404);
        }

        $permission->delete();

        return response()->json(['message' => 'Permission deleted successfully'], 200);
    }

    // show (read detail API)
    public function show($id)
    {
        $permission = Permission::with('user')->find($id);

        if (!$permission) {
            return response()->json([
                'message' => 'Permission not found.',
            ], 404);
        }

        return response()->json(['permission' => $permission], 200);
    }

    // confirm (update status API)
    public function confirm(Request $request, $id)
    {
        Log::info('Confirm method called for permission id: ' . $id);

        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        Log::info('Check permission id: ' . $id);

        $permission = Permission::find($id);
        $permission->update([
            'status' => $request->status,
        ]);

        $permission->load('user');

        return response()->json($permission, 201);
    }

    // filter (filter API)
    public function filter(Request $request)
    {
        $query = Permission::with('user');

        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('month')) {
            $query->whereMonth('created_at', $request->month);
        }

        if ($request->has('year')) {
            $query->whereYear('created_at', $request->year);
        }

        $permissions = $query->get();

        return response()->json($permissions);
    }
}
