<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PegawaiController extends Controller
{
    function index()
    {
        $users = Auth::user();
        return view('Pegawai.dashboardPegawai', compact('users'));
        // echo "<a href='logout'> Logout >> </a>";
    }
    function admin()
    {
        $user = User::where('role', 'pegawai')->get();
        // dd($user);
        return view('dashboardAdmin');
        // echo "<a href='logout'> Logout >> </a>";
    }
    function kasubag()
    {
        return view('kasubag.dashboardKasubag');
        // echo "<a href='logout'> Logout >> </a>";
    }
    public function update(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required',
            'role' => ['required', Rule::in(['pegawai', 'admin', 'kasubag umum'])],
            'jabatan' => ['nullable', 'string', Rule::in(['PNS', 'PPNPN', 'Satpam'])],
            'nip' => 'nullable',
            'pangkat' => 'nullable',
            'golongan' => 'nullable',
            'tandatanggan' => 'nullable|file|mimes:jpeg,png,pdf|max:10000' // Sesuaikan jenis file yang diizinkan dan ukuran maksimum
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Update data user
        $user->update($request->only(['name', 'role', 'jabatan', 'nip', 'pangkat', 'golongan']));

        // Update password jika password baru disediakan
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Update tandatangan jika file baru disediakan
        if ($request->hasFile('tandatanggan')) {
            $tandatanganPath = $request->file('tandatanggan')->store('tandatanggan', 'public');

            // Hapus tandatangan yang ada jika ada
            if ($user->tandatanggan) {
                Storage::disk('public')->delete($user->tandatanggan);
            }

            $user->tandatanggan = $tandatanganPath;
        }

        // Simpan perubahan
        $user->save();

        // Redirect ke dashboardPegawai setelah berhasil
        return redirect('/dashboardPegawai')->with('success', 'Data Pegawai Berhasil Diperbarui');
    }
}
