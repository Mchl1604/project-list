<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('Pages.users', compact('users'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|unique:users,name',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password',
            ]);
            $data['password'] = Hash::make($data['password']);
            User::create($data);
            return redirect('/users')->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            return redirect('/users')->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        try {
            $data = $request->validate([
                'name' => 'required|unique:users,name,' . $user->id,
                'email' => 'required|email|unique:users,email,' . $user->id,
            ]);
            $user->update($data);
            return redirect('/users')->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            return redirect('/users')->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect('/users')->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            return redirect('/users')->with('error', $e->getMessage());
        }
    }
}
