<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function loginindex()
    {
        return view('signIn.login');
    }

    public function registerindex()
    {
        return view('signIn.register');
    }

    public function registerUser(Request $request)
    {
        try{
            $data = $request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);
        $data['password'] = Hash::make($data['password']);

        User::create($data);
        return redirect()->route('login.index')->with('success', 'Registration successful! Please log in.');
        }
        catch(\Exception $e){
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.index');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.index');
    }
}
