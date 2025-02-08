<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function registerUser(SignupRequest $request): RedirectResponse
    {
        // Do we have pfp?
        if ($request->hasFile('profile_picture')) {
            $pfpPath = $request->file('profile_picture')->store('storage/app/public');
        } else {
            $pfpPath = null;
        }

        $data = $request->validated();
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->age = $data['age'];
        $user->dob = $data['dob'];
        $user->address = $data['address'];
        $user->password = Hash::make($data['password']);
        $user->role = $data['role'];
        $user->profile_picture = $pfpPath;
        $user->save();

        return redirect()->intended('signin');
    }

    public function authUser(Request $request): RedirectResponse
    {
        $creds = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($creds)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
