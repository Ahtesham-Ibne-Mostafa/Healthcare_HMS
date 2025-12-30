<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        // validate input
        $request->validate([
            'blood_group' => 'nullable|string|max:3',
            'address'     => 'nullable|string|max:255',
            'phone'       => 'nullable|string|max:20',
        ]);

        // update user profile
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }
        $user->blood_group = $request->blood_group;
        $user->address     = $request->address;
        $user->phone       = $request->phone;
        

        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->emergency_contact = $request->emergency_contact;
        $user->insurance_provider = $request->insurance_provider;
        $user->policy_number = $request->policy_number;
        $user->save();


        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}

