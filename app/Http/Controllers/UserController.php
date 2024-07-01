<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        // search by name, pagination 10
        $users = User::where('name', 'like', '%'.request('name').'%')->orderBy('id', 'desc')
        ->paginate(10);

        return view('pages.users.index', compact('users'));
    }
    
    public function create(){
        return view('pages.users.create');
    }
    
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

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
