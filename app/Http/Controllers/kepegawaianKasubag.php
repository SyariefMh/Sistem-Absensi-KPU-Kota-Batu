<?php

namespace App\Http\Controllers;

use App\Models\nilaiA;
use App\Models\nilaiB;
use App\Models\nilaiC;
use App\Models\periode;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class kepegawaianKasubag extends Controller
{
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
                $editUrl = url('/dashboardKasubag/kepegawaian/edit/' . $row->id);
                $deleteUrl = url('/dashboardKasubag/kepegawaian/destroy/' . $row->id);
                $nilaiUrl = url('/dashboardKasubag/kepegawaian/nilai/' . $row->id);


                return '<a href="' . $editUrl . '">Edit</a> | <a href="#" class="delete-users" data-url="' . $deleteUrl . '">Delete</a> | <a href="' . $nilaiUrl . '">nilai</a>';
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
                $editUrl = url('/dashboardKasubag/kepegawaian/edit/' . $row->id);
                $deleteUrl = url('/dashboardKasubag/kepegawaian/destroy/' . $row->id);
                $nilaiUrl = url('/dashboardKasubag/kepegawaian/nilai/' . $row->id);


                return '<a href="' . $editUrl . '">Edit</a> | <a href="#" class="delete-users" data-url="' . $deleteUrl . '">Delete</a> | <a href="' . $nilaiUrl . '">nilai</a>';
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
                $editUrl = url('/dashboardKasubag/kepegawaian/edit/' . $row->id);
                $deleteUrl = url('/dashboardKasubag/kepegawaian/destroy/' . $row->id);
                $nilaiUrl = url('/dashboardKasubag/kepegawaian/nilai/' . $row->id);


                return '<a href="' . $editUrl . '">Edit</a> | <a href="#" class="delete-users" data-url="' . $deleteUrl . '">Delete</a> | <a href="' . $nilaiUrl . '">nilai</a>';
            })
            ->toJson();
    }
    public function index()
    {
        $periode = periode::all();
        return view('kasubag.dataPegawaiKasubag', compact('periode'));
    }

    public function laporan()
    {
        $users = User::where('role', 'pegawai')->get();

        $user_ids = []; // Array untuk menyimpan id-id user
        foreach ($users as $user) {
            $user_ids[] = $user->id; // Mengambil id dari setiap user dan menambahkannya ke array
        }
        $periode = periode::where('status', 1)->pluck('id')->first();
        $get_nilai = nilaiA::whereIn('user_id', $user_ids)->where('periode_id', '$periode')->get();


        return view('printLaporan', compact('users', 'get_nilai'));
    }
    public function laporanfilter(Request $request, $periode_id)
    {
        $users = User::where('role', 'pegawai')->get();
        // dd($users);

        $user_ids = [];
        foreach ($users as $user) {
            $user_ids[] = $user->id;
        }

        // Logika untuk mendapatkan data laporan berdasarkan $periodeId
        $get_nilai = nilaiA::whereIn('user_id', $user_ids)->where('periode_id', $periode_id)->get();
        // dd($get_nilai);

        if ($get_nilai->isEmpty()) {
            return redirect('/dashboardKasubag/kepegawaian');
        }
        return view('printLaporan', compact('users', 'get_nilai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kasubag.tambahPegawaiKasubag');
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
            'tandatanggan' => 'required|file|mimes:jpeg,png,pdf|max:10000' // Sesuaikan dengan jenis file yang diizinkan dan ukuran maksimal
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
        return redirect('/dashboardKasubag/kepegawaian')->with('success', 'Data Pegawai Berhasil Ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $users = User::find($id);
        return view('kasubag.editpegawaiKasubag', compact('users'));
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

        return redirect('/dashboardKasubag/kepegawaian')->with('success', 'Data Pegawai Berhasil Diperbarui');
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
}
