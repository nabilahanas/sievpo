<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.profile', compact('users'), ['key'=>'users']);
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_pict' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $users = Auth::user();

        if ($request->hasFile('profile_pict')) {
            $image = $request->file('profile_pict');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = 'profile-pict/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($image));

            if ($users->profile_pict) {
                Storage::disk('public')->delete('profile-pict/' . $users->profile_pict);
            }

            $users->update(['profile_pict' => $filename]);
        }

        return redirect()->route('profile.updateProfilePicture')->with('success', 'Foto profil berhasil diubah');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $users = Auth::user();

        // Check if the current password is correct
        if (!Hash::check($request->current_password, $users->password)) {
            return redirect()->route('profile.index')->with('error', 'Password saat ini tidak sesuai.');
        }

        // Update the password
        $users->update(['password' => bcrypt($request->new_password)]);

        return redirect()->route('profile.updatePassword')->with('success', 'Password berhasil diubah');
    }
}
