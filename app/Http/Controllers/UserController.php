<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="List all users",
     *     tags={"user"},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Filter users by name",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *     )
     * )
     */
    public function index(){
        // search by name, pagination 10
        $users = User::where('name', 'like', '%'.request('name').'%')->orderBy('id', 'desc')
        ->paginate(10);

        return view('pages.users.index', compact('users'));
    }
    
    public function create(){
        return view('pages.users.create');
    }
    
    /**
     * @OA\Post(
     *     path="/api/users",
     *     summary="Store a newly created user",
     *     tags={"user"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="john.doe@example.com"),
     *             @OA\Property(property="password", type="string", example="password123"),
     *             @OA\Property(property="phone_number", type="string", example="1234567890"),
     *             @OA\Property(property="role", type="string", example="admin"),
     *             @OA\Property(property="employee_type", type="string", example="full-time"),
     *             @OA\Property(property="department", type="string", example="IT"),
     *             @OA\Property(property="position", type="string", example="Developer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User created successfully"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function store(Request $request) {
        $request->validate([
            'name'  => ['required'],
            'email' => ['required', 'email'],
            'password'=> ['required', 'min:8'],
            // 'company_id' => ['required', 'exists:companies,id'],
        ]);
        
        $user= User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'phone_number'=> $request->phone_number,
            'role'=> $request->role,
            'employee_type'=> $request->employee_type,
            'department'=> $request->department,
            'position'=> $request->position,
            'password'=> Hash::make($request->password),
            // 'company_id' => $request->company_id,
        ]);
        
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user){
        return view('pages.users.edit', compact('user'));
    }

     /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     summary="Update a specific user",
     *     tags={"user"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
    public function update(Request $request, User $user) {
        $request->validate([
            'name'  => ['required'],
            'email' => ['required', 'email'],
            // 'company_id' => ['required', 'exists:companies,id'],
        ]);
        
        $user->update([
            'name'=> $request->name,
            'email'=> $request->email,
            'phone_number'=> $request->phone_number,
            'role'=> $request->role,
            'employee_type'=> $request->employee_type,
            'department'=> $request->department,
            'position'=> $request->position,
            // 'company_id' => $request->company_id,
        ]);

        if ($request->password) {
            $user->update([
                'password'=>Hash::make($request->password)
            ]);
        }
        
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

/**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     summary="Delete a specific user",
     *     tags={"user"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="User deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
