<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\nilaiA;
use App\Models\User;
use App\Models\periode;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generatePdf()
    {
        $users = User::where('role', 'pegawai')->get();
        // dd($users);
        $userIDDD= $users->pluck('id');
        // dd($userIDDD);
        $periode = periode::where('status', 1)->pluck('id')->first();
        $periode_bulan = periode::where('status',1)->first();

        date_default_timezone_set('Asia/Jakarta');
        // Menghitung tanggal awal dan akhir bulan
        $startDate = date('Y-m-01'); // Untuk bulan saat ini
        $endDate = date('Y-m-t'); // Untuk bulan saat ini

        $combinedData = $this->getCombinedData($users, $startDate, $endDate);
        $get_nilai = nilaiA::whereIn('user_id', $userIDDD)->where('periode_id', $periode)->get();

        $pdf = PDF::loadView('kasubag.pdfLaporan',compact('users', 'combinedData', 'startDate', 'endDate','get_nilai','periode','periode_bulan'));
        
        // Menggunakan metode stream untuk menampilkan PDF di browser
        return $pdf->stream('my_pdf_file.pdf');
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
            // dd($combinedData);
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
                'kode_absen' => '-',
            ];
        }
        return $absensi->first();
    }
    
}
