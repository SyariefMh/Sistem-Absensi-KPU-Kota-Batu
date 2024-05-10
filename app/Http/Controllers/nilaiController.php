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
use App\Models\User;
use Illuminate\Http\Request;

class nilaiController extends Controller
{
    public function nilai($id)
    {
        $nilai = User::find($id);
        // dd($nilai);
        $periode = periode::where('status', 1)->pluck('id')->first();
        $periodeall = periode::where('status', 1)->first();
        // dd($periodeall);
        // dd($periode);
        if (!$periode) {
            return redirect('/dashboardKasubag')->withErrors(['errors' => 'Periode Belum Dibuka']);
        }
        $dataNilai = nilaiA::where('user_id', $nilai->id)->where('periode_id', $periode)->first();
        // $dataNilaiB = nilaiB::where('user_id', $nilai->id)->where('periode_id', $periode)->first();
        // $dataNilaiC = nilaiC::where('user_id', $nilai->id)->where('periode_id', $periode)->first();
        $jumlahizin = optional(Izin::where('user_id', $nilai->id)->where('periode_id', $periode))->count() ?: 0;
        // dd($jumlahizin);
        // $jumlahizin = izin::where('user_id', $nilai->id)->where('periode_id',$periode)->count();
        // dd($jumlahizin);
        $jumlahcuti = optional(Cuti::where('user_id', $nilai->id)->where('periode_id', $periode))->count() ?: 0;
        $dinlurCount = optional(Dinlur::where('user_id', $nilai->id)->where('periode_id', $periode))->count() ?: 0;
        $datangQrCodeCount = optional(DatangQrCode::where('user_id', $nilai->id)->where('periode_id', $periode))->count() ?: 0;

        $totalCount = $dinlurCount + $datangQrCodeCount;
        // dd($totalCount);

        $cuti = Cuti::where('user_id', $nilai->id)
            ->get();

        $izins = Izin::where('user_id', $nilai->id)
            ->get();
        // dd($izins);
        $dinlur = Dinlur::where('user_id', $nilai->id)
            ->get();

        $qrcode = DatangQrCode::whereIn('qrcode_id', function ($query) use ($nilai) {
            $query->select('id')
                ->from('qrcode_gens')
                ->where('user_id', $nilai->id);
        })
            ->get();

        $combinedData = $cuti->merge($izins)->merge($dinlur)->merge($qrcode)->pluck('tanggal');
        // dd($combinedData);

        $terlambat = datangQrCode::where('Status','Terlambat')
        ->where('user_id',$nilai->id)->get()->count();

        // dd($dataNilai);
        return view('kasubag.penilaianPegawai', compact('nilai', 'periode', 'periodeall', 'dataNilai', 'jumlahizin', 'totalCount', 'jumlahcuti','combinedData','terlambat'));
    }
    // public function simpan(Request $request)
    // {
    //     // Validasi data jika diperlukan
    //     $validatedData = $request->validate([
    //         'kriteria1' => 'required',
    //         'kriteria2' => 'required',
    //         'kriteria3' => 'required',
    //         'kriteria4' => 'required',
    //         'nilai1' => 'required|numeric',
    //         'nilai2' => 'required|numeric',
    //         'nilai3' => 'required|numeric',
    //         'nilai4' => 'required|numeric',
    //         'user_id' => 'required',
    //         'periode_id' => 'required',
    //     ]);

    //     // Simpan data ke database
    //     $exitingData = NilaiA::where('user_id', $request->user_id)->first();
    //     if ($exitingData) {
    //         $exitingData->update([
    //             'kriteria1' => $request->kriteria1a,
    //             'kriteria2' => $request->kriteria2a,
    //             'kriteria3' => $request->kriteria3a,
    //             'kriteria4' => $request->kriteria4a,
    //             'nilai1' => $request->nilai1a,
    //             'nilai2' => $request->nilai2a,
    //             'nilai3' => $request->nilai3a,
    //             'nilai4' => $request->nilai4a,
    //             'user_id' => $request->user_ida,
    //             'periode_id' => $request->periode_ida,
    //         ]);
    //     } else {
    //         NilaiA::create([
    //             'kriteria1' => $request->kriteria1a,
    //             'kriteria2' => $request->kriteria2a,
    //             'kriteria3' => $request->kriteria3a,
    //             'kriteria4' => $request->kriteria4a,
    //             'nilai1' => $request->nilai1a,
    //             'nilai2' => $request->nilai2a,
    //             'nilai3' => $request->nilai3a,
    //             'nilai4' => $request->nilai4a,
    //             'user_id' => $request->user_ida,
    //             'periode_id' => $request->periode_ida,
    //             // Sesuaikan dengan kolom lain yang ada dalam model NilaiA
    //         ]);
    //     }


    //     // Simpan data ke database
    //     $exitingData = nilaiB::where('user_id', $request->user_id)->first();
    //     if ($exitingData) {
    //         $exitingData->update([
    //             'kriteria1' => $request->kriteria1b,
    //             'kriteria2' => $request->kriteria2b,
    //             'kriteria3' => $request->kriteria3b,
    //             'kriteria4' => $request->kriteria4b,
    //             'nilai1' => $request->nilai1b,
    //             'nilai2' => $request->nilai2b,
    //             'nilai3' => $request->nilai3b,
    //             'nilai4' => $request->nilai4b,
    //             'user_id' => $request->user_idb,
    //             'periode_id' => $request->periode_idb,
    //         ]);
    //     } else {
    //         nilaiB::create([
    //             'kriteria1' => $request->kriteria1b,
    //             'kriteria2' => $request->kriteria2b,
    //             'kriteria3' => $request->kriteria3b,
    //             'kriteria4' => $request->kriteria4b,
    //             'nilai1' => $request->nilai1b,
    //             'nilai2' => $request->nilai2b,
    //             'nilai3' => $request->nilai3b,
    //             'nilai4' => $request->nilai4b,
    //             'user_id' => $request->user_idb,
    //             'periode_id' => $request->periode_idb,
    //             // Sesuaikan dengan kolom lain yang ada dalam model NilaiA
    //         ]);
    //     }


    //     // Simpan data ke database
    //     $exitingData = nilaiC::where('user_id', $request->user_id)->first();
    //     if ($exitingData) {
    //         $exitingData->update([
    //             'kriteria1' => $request->kriteria1c,
    //             'kriteria2' => $request->kriteria2c,
    //             'kriteria3' => $request->kriteria3c,
    //             'kriteria4' => $request->kriteria4c,
    //             'nilai1' => $request->nilai1c,
    //             'nilai2' => $request->nilai2c,
    //             'nilai3' => $request->nilai3c,
    //             'nilai4' => $request->nilai4c,
    //             'user_id' => $request->user_idc,
    //             'periode_id' => $request->periode_idc,
    //         ]);
    //     } else {
    //         nilaiC::create([
    //             'kriteria1' => $request->kriteria1c,
    //             'kriteria2' => $request->kriteria2c,
    //             'kriteria3' => $request->kriteria3c,
    //             'kriteria4' => $request->kriteria4c,
    //             'nilai1' => $request->nilai1c,
    //             'nilai2' => $request->nilai2c,
    //             'nilai3' => $request->nilai3c,
    //             'nilai4' => $request->nilai4c,
    //             'user_id' => $request->user_idc,
    //             'periode_id' => $request->periode_idc,
    //             // Sesuaikan dengan kolom lain yang ada dalam model NilaiA
    //         ]);
    //     }
    //     dd($request->all());
    //     // Redirect atau kembali ke halaman sebelumnya
    //     return redirect('/dashboardKasubag/kepegawaian')->with('success', 'Data berhasil disimpan.');
    // }

    public function simpan(Request $request)
    {
        // Validasi data jika diperlukan
        $validatedData = $request->validate([
            'kriteria1_A' => 'required',
            'kriteria2_A' => 'required',
            'kriteria3_A' => 'required',
            'kriteria4_A' => 'required',
            'nilai1_A' => 'required|numeric',
            'nilai2_A' => 'required|numeric',
            'nilai3_A' => 'required|numeric',
            'nilai4_A' => 'required|numeric',
            'kriteria1_B' => 'required',
            'kriteria2_B' => 'required',
            'kriteria3_B' => 'required',
            'kriteria4_B' => 'required',
            'kriteria5_B' => 'required',
            'nilai1_B' => 'required|numeric',
            'nilai2_B' => 'required|numeric',
            'nilai3_B' => 'required|numeric',
            'nilai4_B' => 'required|numeric',
            'nilai5_B' => 'required|numeric',
            'kriteria1_C' => 'required',
            'kriteria2_C' => 'required',
            'kriteria3_C' => 'required',
            'kriteria4_C' => 'required',
            'kriteria5_C' => 'required',
            'nilai1_C' => 'required|numeric',
            'nilai2_C' => 'required|numeric',
            'nilai3_C' => 'required|numeric',
            'nilai4_C' => 'required|numeric',
            'nilai5_C' => 'required|numeric',
            'user_id' => 'required',
            'periode_id' => 'required',
        ]);

        $exitingData = NilaiA::where('user_id', $request->user_id)->first();
        if ($exitingData) {
            $exitingData->update([
                'kriteria1_A' => $request->kriteria1_A,
                'kriteria2_A' => $request->kriteria2_A,
                'kriteria3_A' => $request->kriteria3_A,
                'kriteria4_A' => $request->kriteria4_A,
                'nilai1_A' => $request->nilai1_A,
                'nilai2_A' => $request->nilai2_A,
                'nilai3_A' => $request->nilai3_A,
                'nilai4_A' => $request->nilai4_A,
                'kriteria1_B' => $request->kriteria1_B,
                'kriteria2_B' => $request->kriteria2_B,
                'kriteria3_B' => $request->kriteria3_B,
                'kriteria4_B' => $request->kriteria4_B,
                'kriteria5_B' => $request->kriteria4_B,
                'nilai1_B' => $request->nilai1_B,
                'nilai2_B' => $request->nilai2_B,
                'nilai3_B' => $request->nilai3_B,
                'nilai4_B' => $request->nilai4_B,
                'nilai5_B' => $request->nilai4_B,
                'kriteria1_C' => $request->kriteria1_C,
                'kriteria2_C' => $request->kriteria2_C,
                'kriteria3_C' => $request->kriteria3_C,
                'kriteria4_C' => $request->kriteria4_C,
                'kriteria5_C' => $request->kriteria4_C,
                'nilai1_C' => $request->nilai1_C,
                'nilai2_C' => $request->nilai2_C,
                'nilai3_C' => $request->nilai3_C,
                'nilai4_C' => $request->nilai4_C,
                'nilai5_C' => $request->nilai4_C,
            ]);
        } else {
            NilaiA::create([
                'kriteria1_A' => $request->kriteria1_A,
                'kriteria2_A' => $request->kriteria2_A,
                'kriteria3_A' => $request->kriteria3_A,
                'kriteria4_A' => $request->kriteria4_A,
                'nilai1_A' => $request->nilai1_A,
                'nilai2_A' => $request->nilai2_A,
                'nilai3_A' => $request->nilai3_A,
                'nilai4_A' => $request->nilai4_A,
                'kriteria1_B' => $request->kriteria1_B,
                'kriteria2_B' => $request->kriteria2_B,
                'kriteria3_B' => $request->kriteria3_B,
                'kriteria4_B' => $request->kriteria4_B,
                'kriteria5_B' => $request->kriteria4_B,
                'nilai1_B' => $request->nilai1_B,
                'nilai2_B' => $request->nilai2_B,
                'nilai3_B' => $request->nilai3_B,
                'nilai4_B' => $request->nilai4_B,
                'nilai5_B' => $request->nilai4_B,
                'kriteria1_C' => $request->kriteria1_C,
                'kriteria2_C' => $request->kriteria2_C,
                'kriteria3_C' => $request->kriteria3_C,
                'kriteria4_C' => $request->kriteria4_C,
                'kriteria5_C' => $request->kriteria4_C,
                'nilai1_C' => $request->nilai1_C,
                'nilai2_C' => $request->nilai2_C,
                'nilai3_C' => $request->nilai3_C,
                'nilai4_C' => $request->nilai4_C,
                'nilai5_C' => $request->nilai4_C,
                'user_id' => $request->user_id,
                'periode_id' => $request->periode_id,
                // Sesuaikan dengan kolom lain yang ada dalam model NilaiA
            ]);
        }

        // Redirect atau kembali ke halaman sebelumnya
        return redirect('/dashboardKasubag/kepegawaian')->with('success', 'Data berhasil disimpan.');
    }
}
