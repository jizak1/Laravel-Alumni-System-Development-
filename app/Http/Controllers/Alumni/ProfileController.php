<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $profile = $user->profile;
        
        return view('alumni.profile.edit', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
            'alamat' => ['nullable', 'string'],
            'telepon' => ['nullable', 'string', 'max:20'],
            'pekerjaan' => ['nullable', 'string', 'max:255'],
            'tahun_lulus' => ['nullable', 'integer', 'min:1900', 'max:' . (date('Y') + 10)],
            'nim' => ['nullable', 'string', 'max:20'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user = auth()->user();
        
        // Update user data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update or create profile
        $profileData = $request->only(['alamat', 'telepon', 'pekerjaan', 'tahun_lulus', 'nim']);

        if ($request->hasFile('foto')) {
            // Delete old photo
            if ($user->profile && $user->profile->foto) {
                Storage::disk('public')->delete($user->profile->foto);
            }
            $profileData['foto'] = $request->file('foto')->store('profiles', 'public');
        }

        if ($user->profile) {
            $user->profile->update($profileData);
        } else {
            $user->profile()->create($profileData);
        }

        return redirect()->route('alumni.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
