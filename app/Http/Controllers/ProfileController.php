<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\User;
use SebastianBergmann\Type\TrueType;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('Pages.profile', compact('user'));
    }

public function updateProfilePicture(Request $request)
{
    try {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Auth::user();
        $image = $request->file('profile_image');
        $fileName = time() . '_' . $user->id . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('profileImage');

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        if ($user->profile_image && File::exists(public_path($user->profile_image))) {
            File::delete(public_path($user->profile_image));
        }

        
        move_uploaded_file(
            $_FILES['profile_image']['tmp_name'],
            $destinationPath . DIRECTORY_SEPARATOR . $fileName
        );

        $user->update([
            'profile_image' => 'profileImage/' . $fileName,
        ]);

        return redirect()->route('profile')->with('success', 'Profile picture updated successfully!');
    } catch (\Exception $e) {
        return redirect()->route('profile')->with('error', 'An error occurred while updating the profile picture: ' . $e->getMessage());
    }
}

    public function updateProfileInformation(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'         => 'sometimes|required|unique:users,name,' . $user->id,
            'email'        => 'sometimes|required|email|unique:users,email,' . $user->id,
            'old_password' => 'nullable',
            'new_password' => 'nullable|min:6|confirmed',
        ]);

        if ($request->filled('new_password') && !$request->filled('old_password')) {
            return redirect()->route('profile')->with('error', 'Old password is required when changing your password.');
        }

        if ($request->filled('old_password') && !password_verify($request->input('old_password'), $user->password)) {
            return redirect()->route('profile')->with('error', 'Old password is incorrect.');
        }

        $data = $request->only(['name', 'email']);

        if ($request->filled('new_password')) {
            $data['password'] = bcrypt($request->input('new_password'));
        }

        $user->update($data);

        return redirect()->route('profile')->with('success', 'Profile information updated successfully!');
    }
}