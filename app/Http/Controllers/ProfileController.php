<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::guard('student')->user(); // Retrieve the authenticated student

        if ($user) {
            return view('shopping.profile', ['user' => $user]);
        }

        // If user is not authenticated, redirect to login
        return redirect()->route('shopping.login')->with('error', 'Please login to view your profile');
    }

    public function edit()
    {
        $user = Auth::guard('student')->user();

        if ($user) {
            return view('shopping.profile_edit', ['user' => $user]);
        }

        return redirect()->route('shopping.login')->with('error', 'Please login to edit your profile');
    }

    public function update(Request $request)
    {
        $user = Auth::guard('student')->user();

        if ($user) {
            // Validation rules for updating profile
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:students,email,' . $user->id,
                'phone' => 'required|numeric|min:10|unique:students,phone,' . $user->id,
              
                'city' => 'required|string|max:255',
            ]);

            // Update user profile
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
           
            $user->city = $request->city;
            $user->save();

            return redirect()->route('user.profile')->with('success', 'Profile updated successfully');
        }

        return redirect()->route('shopping.login')->with('error', 'Please login to update your profile');
    }
}