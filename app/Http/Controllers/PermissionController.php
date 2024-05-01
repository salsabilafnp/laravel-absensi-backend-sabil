<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    // index
    public function index(Request $request)
    {
        $permissions = Permission::with('user')->when($request->input('name'), function ($query, $name){
            $query->whereHas('user', function ($query) use ($name){
                $query->where('name', 'like', '%'.$name.'%');
            });
        })->latest()->paginate(10);

        return view('pages.permission.index', compact('permissions'));
    }

    // show
    public function show($id)
    {
        $permission = Permission::with('user')->find($id);
        return view('pages.permission.show', compact('permission'));
    }

    // edit
    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('pages.permission.edit', compact('permission'));
    }

    // update
    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);
        $permission->status = $request->status;
        $permission->save();

        return redirect()->route('permissions.index')->with('success', 'Permission status updated');
    }

    // destroy
    public function destroy($id)
    {
        Permission::find($id)->delete();
        return redirect()->route('permissions.index');
    }
}
