<?php

namespace App\Http\Controllers;

use App\Models\cuti;
use App\Models\datangQrCode;
use App\Models\dinlur;
use App\Models\izin;
use App\Models\nilaiA;
use App\Models\nilaiB;
use App\Models\nilaiC;
use App\Models\periode;
use App\Models\pulangQrCode;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        // dd($users);
        $userIDDD = $users->pluck('id');
        // dd($userIDDD);
        $periode = periode::where('status', 1)->pluck('id')->first();

        date_default_timezone_set('Asia/Jakarta');
        // Menghitung tanggal awal dan akhir bulan
        $startDate = date('Y-m-01'); // Untuk bulan saat ini
        $endDate = date('Y-m-t'); // Untuk bulan saat ini

        $combinedData = $this->getCombinedData($users, $startDate, $endDate);
        $get_nilai = nilaiA::whereIn('user_id', $userIDDD)->where('periode_id', $periode)->get();

        return view('printLaporan', compact('users', 'combinedData', 'startDate', 'endDate', 'get_nilai'));
    }

    private function getCombinedData($users, $startDate, $endDate)
    {
        $combinedData = collect();
        $periode = periode::where('status', 1)->pluck('id')->first();

        foreach ($users as $user) {
            $userCombinedData = collect();

            // Loop melalui setiap tanggal dalam rentang
            $currentDate = $startDate;
            while ($currentDate <= $endDate) {
                // Mencari data absensi untuk pengguna pada tanggal saat ini
                $userAbsensi = $this->getUserAbsensi($user->id, $currentDate);

                // Menambahkan data absensi ke dalam koleksi
                $userCombinedData->push($userAbsensi);

                // Maju ke tanggal berikutnya
                $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
            }

            $get_nilai = nilaiA::where('user_id', $user->id)->where('periode_id', $periode)->first();

            // Menambahkan koleksi data absensi pengguna ke dalam koleksi gabungan
            $combinedData->push([
                'user' => $user,
                'absensi' => $userCombinedData,
                'get_nilai' => $get_nilai,
            ]);
        }

        return $combinedData;
    }

    private function getUserAbsensi($userId, $tanggal)
    {
        // Mencari data absensi untuk pengguna pada tanggal tertentu
        $absensi = collect();

        // Ambil data absensi dari setiap jenis
        $jenisAbsensi = ['dinlurs', 'cutis', 'izins', 'datangQrCode'];
        foreach ($jenisAbsensi as $jenis) {
            $absensiData = DB::table($jenis)
                ->where('user_id', $userId)
                ->where('tanggal', $tanggal)
                ->first();

            if ($absensiData) {
                $absensi->push($absensiData);
            }
        }

        // Jika tidak ada data absensi, kembalikan nilai default
        if ($absensi->isEmpty()) {
            return (object)[
                'user_id' => $userId,
                'tanggal' => $tanggal,
                'jam_datang' => '-',
                'jam_pulang' => '-',
                'Keterangan' => '-',
                'Status' => '-',
            ];
        }

        return $absensi->first();
    }
    private function filterCombinedData($users, $startDate, $endDate, $periodeId)
    {
        $combinedData = collect();

        foreach ($users as $user) {
            $userCombinedData = collect();

            // Loop melalui setiap tanggal dalam rentang
            $currentDate = $startDate;
            while ($currentDate <= $endDate) {
                // Mencari data absensi untuk pengguna pada tanggal saat ini dan periode yang sesuai
                $userAbsensi = $this->filterUserAbsensi($user->id, $currentDate,  $periodeId);

                // Menambahkan data absensi ke dalam koleksi jika data ada
                if ($userAbsensi !== null) {
                    $userCombinedData->push($userAbsensi);
                }

                // Maju ke tanggal berikutnya
                $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
            }

            $get_nilai = nilaiA::where('user_id', $user->id)->where('periode_id', $periodeId)->first();

            // Menambahkan koleksi data absensi pengguna ke dalam koleksi gabungan
            $combinedData->push([
                'user' => $user,
                'absensi' => $userCombinedData,
                'get_nilai' => $get_nilai,
            ]);
        }

        return $combinedData;
    }

    private function filterUserAbsensi($userId, $tanggal, $periodeId)
    {
        // Mencari data absensi untuk pengguna pada tanggal tertentu
        $absensi = collect();

        // Ambil data absensi dari setiap jenis
        $jenisAbsensi = ['dinlurs', 'cutis', 'izins', 'datangQrCode'];
        foreach ($jenisAbsensi as $jenis) {
            $absensiData = DB::table($jenis)
                ->where('user_id', $userId)
                ->where('tanggal', $tanggal)
                ->where(
                    'periode_id',
                    $periodeId
                )
                ->first();
            // dd($absensiData);

            if ($absensiData) {
                $absensi->push($absensiData);
            }
        }

        // Jika tidak ada data absensi, kembalikan nilai default
        if ($absensi->isEmpty()) {
            return (object)[
                'user_id' => $userId,
                'tanggal' => $tanggal,
                'jam_datang' => '-',
                'jam_pulang' => '-',
                'Keterangan' => '-',
                'Status' => '-',
                'kode_absen' => '-',
            ];
        }

        return $absensi->first();
    }


    public function laporanfilter(Request $request, $periode_id)
    {
        $users = User::where('role', 'pegawai')->get();
        // dd($users);
        $userIDDD = $users->pluck('id');
        // dd($userIDDD);

        $periodeId = $periode_id; // Gunakan periode_id dari parameter route
        $periode = periode::find($periodeId); // Ambil periode berdasarkan periode_id dari parameter route

        date_default_timezone_set('Asia/Jakarta');
        // Menghitung tanggal awal dan akhir bulan
        $startDate = date('Y-m-01'); // Untuk bulan saat ini
        $endDate = date('Y-m-t'); // Untuk bulan saat ini

        $combinedData = $this->filterCombinedData($users, $startDate, $endDate, $periodeId);
        // dd($combinedData);

        $get_nilai = nilaiA::whereIn('user_id', $userIDDD)->where('periode_id', $periodeId)->get();

        // // Logika untuk mendapatkan data laporan berdasarkan $periodeId
        // $get_nilai = nilaiA::whereIn('user_id', $user_ids)->where('periode_id', $periode_id)->get();
        // dd($get_nilai);

        if ($get_nilai->isEmpty()) {
            return redirect('/dashboardKasubag/kepegawaian')->with('error', 'Data nilai tidak ditemukan untuk periode yang dipilih.');
        }
        $pdf = PDF::loadView('kasubag.pdfLaporan', compact('users', 'combinedData', 'startDate', 'endDate', 'get_nilai'));

        // Menggunakan metode stream untuk menampilkan PDF di browser
        return $pdf->stream('my_pdf_file.pdf');
        // return view('printLaporan', compact('users', 'get_nilai'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kasubag.tambahPegawaiKasubag');
    }

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
        return redirect('/dashboardKasubag/kepegawaian')->with('success', 'Data Pegawai Berhasil Ditambahkan');
    }


    /**
     * Display the specified resource.
     */


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
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);

            // Hapus semua relasi yang terkait dengan user tersebut
            DB::table('datangqrcode')->where('user_id', $id)->delete();
            DB::table('izins')->where('user_id', $id)->delete();
            DB::table('cutis')->where('user_id', $id)->delete();
            DB::table('dinlurs')->where('user_id', $id)->delete();
            DB::table('qrcode_gens')->where('user_id', $id)->delete();

            // Hapus file tandatangan user jika ada
            if ($user->tandatanggan) {
                Storage::disk('public')->delete($user->tandatanggan);
            }

            // Hapus user
            $user->delete();

            // Commit transaksi
            DB::commit();

            // Return JSON response indicating success
            return response()->json(['message' => 'Data Pegawai Berhasil Dihapus']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            // Return JSON response indicating failure
            return response()->json(['message' => 'Gagal menghapus data pegawai: ' . $e->getMessage()], 500);
        }
    }




    // public function destroy(string $id)
    // {
    //     $user = User::findOrFail($id);

    //     // Delete the user's tandatangan file if it exists
    //     if ($user->tandatanggan) {
    //         Storage::disk('public')->delete($user->tandatanggan);
    //     }

    //     // Delete the user
    //     $user->delete();

    //     // Return a JSON response indicating success
    //     return response()->json(['message' => 'Data Pegawai Berhasil Dihapus']);
    // }

    public function importUsers(Request $request)
    {
        $file = $request->file('file');

        Excel::import(new UsersImport, $file);

        return redirect()->back()->with('success', 'Data imported successfully.');
    }
}
