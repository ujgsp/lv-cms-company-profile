<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class DashboardProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profiles.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        try {

            $user = Auth::user();
            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $request->validate([
                    'password' => 'required|string|min:8|confirmed',
                ]);
                $user->password = bcrypt($request->password);
            }

            $user->save();

            return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error updating profile: ' . $th->getMessage());

            return redirect()->route('profile.edit')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }
}
