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
    public function index(Request $request)
    {
        $users = User::all();
        // Mendapatkan nilai tab dari query string jika ada
        $activeTab = $request->query('tab', 'info'); // Jika tidak ada parameter tab, maka tab "info" akan menjadi default

        return view('users.profile', compact('users', 'activeTab'), ['key' => 'users']);
    }


    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_pict' => 'nullable|image|mimes:jpeg,png,jpg,svg',
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

        return redirect()->route('profile.index', ['tab' => 'editfoto'])->with('success', 'Foto profil berhasil diubah');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed', // Konfirmasi dilakukan secara otomatis oleh Laravel
        ], [
            'new_password.confirmed' => 'Password baru dan konfirmasi password harus cocok.',
        ]);
    
        $user = Auth::user();
    
        // Check if the current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('profile.index', ['tab' => 'editpass'])->with('error', 'Gagal karena password lama tidak sesuai.');
        }
    
        // Update the password
        $user->update(['password' => bcrypt($request->new_password)]);
    
        return redirect()->route('profile.index', ['tab' => 'editpass'])->with('success', 'Password berhasil diubah');
    }   


    public function deleteProfilePicture()
    {
        $user = Auth::user();

        // Hapus referensi foto profil dari database
        $user->update(['profile_pict' => null]);

        return redirect()->route('profile.index', ['tab' => 'editfoto'])->with('success', 'Foto profil berhasil dihapus');
    }
}
