<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class profileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Auth::user();
        return view('pegawai.profile',compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // $user = User::findOrFail($id);
        $users = Auth::user();
        $request->validate([
            'name' => 'required',
            'role' => ['required', Rule::in(['pegawai', 'admin', 'kasubag umum'])],
            'jabatan' => ['nullable', 'string', Rule::in(['PNS', 'PPNPN', 'Satpam'])],
            'nip' => 'nullable',
            'pangkat' => 'nullable',
            'golongan' => 'nullable',
            'tandatanggan' => 'nullable|file|mimes:jpeg,png,pdf|max:10000' // Adjust the allowed file types and maximum size
        ]);

        // Update user data
        $users->update([
            'name' => $request->name,
            'role' => $request->role,
            'jabatan' => $request->jabatan,
            'nip' => $request->nip,
            'pangkat' => $request->pangkat,
            'golongan' => $request->golongan,
        ]);

        // Update password if a new password is provided
        if ($request->filled('password')) {
            $encryptedPassword = bcrypt($request->password);
            $users->update(['password' => $encryptedPassword]);
        }

        // Update tandatangan only if a new file is provided
        if ($request->hasFile('tandatanggan')) {
            $tandatanganPath = $request->file('tandatanggan')->store('tandatanggan', 'public');

            // Delete the existing tandatangan if it exists
            if ($users->tandatanggan) {
                Storage::disk('public')->delete($users->tandatanggan);
            }

            $users->update(['tandatanggan' => $tandatanganPath]);
        }

        return redirect('/dashboardPegawai/profile')->with('success', 'Data Pegawai Berhasil Diperbarui');
    }
}
