<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        $profile = Admin::first();
        return view('admin.auth.profile', compact('profile'));
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255|email',
            'password' => [
                'nullable',
                'string',
                'min:8', // Minimum 8 characters
                'regex:/[A-Z]/', // At least one uppercase letter
                'regex:/[a-z]/', // At least one lowercase letter
                'regex:/[0-9]/' // At least one number
            ]
        ], [
            'password.regex' => 'The password must include at least one uppercase letter, one lowercase letter, and one number.',
        ]);
       $profile = Admin::first();

       if (!$profile) {
            $profile = new Admin;
        }

        $profile->name = $request->input('name');
        $profile->email = $request->input('email');

        if ($request->filled('password')) {
            $profile->password = bcrypt($request->input('password'));
        }

        if ($profile->isDirty()) {
            $profile->save();
            return redirect()->back()->with('status', 'Profile updated successfully!');
        } else {
            return redirect()->back()->with('error', 'No changes were made to the profile.');
        }

    }
}
