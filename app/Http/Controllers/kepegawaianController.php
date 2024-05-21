<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;


class kepegawaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ambildataPns()
    {
        $users = User::select(['id', 'name', 'jabatan', 'nip', 'pangkat', 'golongan'])
            ->where('role', 'pegawai') // Filter role pegawai
            ->where('jabatan', 'PNS'); // Filter jabatan PNS

        $index = 1;

        return DataTables::of($users)
            ->addColumn('DT_RowIndex', function ($data) use (&$index) {
                return $index++; // Menambahkan nomor urutan baris
            })
            ->addColumn('action', function ($row) {
                $editUrl = url('/dashboardAdmin/kepegawaian/edit/' . $row->id);
                $deleteUrl = url('/dashboardAdmin/kepegawaian/destroy/' . $row->id);
                // $qrcodeDatangUrl = url('/dashboardAdmin/kepegawaian/qrcodeDatang/' . $row->id);
                // $qrcodePulangUrl = url('/dashboardAdmin/kepegawaian/qrcodePulang/' . $row->id);

                return '<a href="' . $editUrl . '">Edit</a> | 
                <a href="#" class="delete-users" data-url="' . $deleteUrl . '">Delete</a>';
            })
            ->toJson();
    }

    public function ambildataPpnpn()
    {
        $users = User::select(['id', 'name', 'jabatan', 'nip', 'pangkat', 'golongan'])
            ->where('role', 'pegawai') // Filter role pegawai
            ->where('jabatan', 'PPNPN'); // Filter jabatan PNS
        $index = 1;
        return DataTables::of($users)
            ->addColumn('DT_RowIndex', function ($data) use (&$index) {
                return $index++; // Menambahkan nomor urutan baris
            })
            ->addColumn('action', function ($row) {
                $editUrl = url('/dashboardAdmin/kepegawaian/edit/' . $row->id);
                $deleteUrl = url('/dashboardAdmin/kepegawaian/destroy/' . $row->id);
                // $qrcodeDatangUrl = url('/dashboardAdmin/kepegawaian/qrcodeDatang/' . $row->id);
                // $qrcodePulangUrl = url('/dashboardAdmin/kepegawaian/qrcodePulang/' . $row->id);

                return '<a href="' . $editUrl . '">Edit</a> | <a href="#" class="delete-users" data-url="' . $deleteUrl . '">Delete</a>';
            })
            ->toJson();
    }

    public function ambildataSatpam()
    {
        $users = User::select(['id', 'name', 'jabatan', 'nip', 'pangkat', 'golongan'])
            ->where('role', 'pegawai') // Filter role pegawai
            ->where('jabatan', 'Satpam'); // Filter jabatan PNS
        $index = 1;
        return DataTables::of($users)
            ->addColumn('DT_RowIndex', function ($data) use (&$index) {
                return $index++; // Menambahkan nomor urutan baris
            })
            ->addColumn('action', function ($row) {
                $editUrl = url('/dashboardAdmin/kepegawaian/edit/' . $row->id);
                $deleteUrl = url('/dashboardAdmin/kepegawaian/destroy/' . $row->id);
                // $qrcodeDatangUrl = url('/dashboardAdmin/kepegawaian/qrcodeDatang/' . $row->id);
                // $qrcodePulangUrl = url('/dashboardAdmin/kepegawaian/qrcodePulang/' . $row->id);

                return '<a href="' . $editUrl . '">Edit</a> | <a href="#" class="delete-users" data-url="' . $deleteUrl . '">Delete</a>';
            })
            ->toJson();
    }
    public function index()
    {
        return view('dataPegawai');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tambahPegawai');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'role' => ['required', Rule::in(['pegawai', 'admin', 'kasubag umum'])],
            'jabatan' => ['nullable', 'string', Rule::in(['PNS', 'PPNPN', 'Satpam'])],
            'nip' => 'nullable',
            'pangkat' => 'nullable',
            'golongan' => 'nullable',
            'tandatanggan' => 'nullable|file|mimes:jpeg,png,pdf|max:10000' // Sesuaikan dengan jenis file yang diizinkan dan ukuran maksimal
        ]);

        // dd($request->all());
        $encryptedPassword = bcrypt($request->password);

        $user = User::create([
            'name' => $request->name,
            'password' => $encryptedPassword,
            'role' => $request->role,
            'jabatan' => $request->jabatan,
            'nip' => $request->nip,
            'pangkat' => $request->pangkat,
            'golongan' => $request->golongan,
        ]);

        // Mengelola file tandatangan
        if ($request->hasFile('tandatanggan')) {
            $tandatanganPath = $request->file('tandatanggan')->store('tandatanggan', 'public');
            $user->update(['tandatanggan' => $tandatanganPath]);
        }
        return redirect('/dashboardAdmin/kepegawaian')->with('success', 'Data Pegawai Berhasil Ditambahkan');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::find($id);
        return view('editpegawai', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

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
        $user->update([
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
            $user->update(['password' => $encryptedPassword]);
        }

        // Update tandatangan only if a new file is provided
        if ($request->hasFile('tandatanggan')) {
            $tandatanganPath = $request->file('tandatanggan')->store('tandatanggan', 'public');

            // Delete the existing tandatangan if it exists
            if ($user->tandatanggan) {
                Storage::disk('public')->delete($user->tandatanggan);
            }

            $user->update(['tandatanggan' => $tandatanganPath]);
        }

        return redirect('/dashboardAdmin/kepegawaian')->with('success', 'Data Pegawai Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Delete the user's tandatangan file if it exists
        if ($user->tandatanggan) {
            Storage::disk('public')->delete($user->tandatanggan);
        }

        // Delete the user
        $user->delete();

        // Return a JSON response indicating success
        return response()->json(['message' => 'Data Pegawai Berhasil Dihapus']);
    }
    public function importUsers(Request $request)
    {
        $file = $request->file('file');

        try {
            $import = new UsersImport();
            Excel::import($import, $file);

            return redirect()->back()->with('success', 'Data berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengimpor data.');
        }
    }
}
