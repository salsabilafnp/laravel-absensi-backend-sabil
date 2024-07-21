<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/permissions",
     *     summary="List all permissions",
     *     tags={"permission"},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Filter permissions by user name",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *     )
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/api/permissions/{id}",
     *     summary="Get a specific permission",
     *     tags={"permission"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Permission not found"
     *     )
     * )
     */
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

    /**
     * @OA\Put(
     *     path="/api/permissions/{id}",
     *     summary="Update a specific permission",
     *     tags={"permission"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", description="Status of the permission", example="approved")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Permission updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Permission not found"
     *     )
     * )
     */
    // update
    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);
        $permission->status = $request->status;
        $permission->save();

        return redirect()->route('permissions.index')->with('success', 'Permission status updated');
    }

    /**
     * @OA\Delete(
     *     path="/api/permissions/{id}",
     *     summary="Delete a specific permission",
     *     tags={"permission"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Permission deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Permission not found"
     *     )
     * )
     */
    // destroy
    public function destroy($id)
    {
        Permission::find($id)->delete();
        return redirect()->route('permissions.index');
    }
}
