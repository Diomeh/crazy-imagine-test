<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
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
        $user->name = $data->name;
        $user->email = $data->email;
        $user->age = $data->age;
        $user->dob = $data->dob;
        $user->address = $data->address;
        $user->password = Hash::make($data->password);
        $user->role = $data->role;
        $user->profile_picture = $pfpPath;
        $user->save();

        return redirect()->route('signup')->with('success', 'User registered successfully!');
    }
}
