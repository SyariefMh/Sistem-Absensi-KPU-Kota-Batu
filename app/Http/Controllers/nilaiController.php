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
        $dataNilai = nilaiA::where('user_id', $nilai->id)->where('periode_id',$periode)->first();
        $dataNilaiB = nilaiB::where('user_id', $nilai->id)->where('periode_id',$periode)->first();
        $dataNilaiC = nilaiC::where('user_id', $nilai->id)->where('periode_id',$periode)->first();
        $jumlahizin = optional(Izin::where('user_id', $nilai->id)->where('periode_id',$periode))->count() ?: 0;
        // dd($jumlahizin);
        // $jumlahizin = izin::where('user_id', $nilai->id)->where('periode_id',$periode)->count();
        // dd($jumlahizin);
        $jumlahcuti = optional(Cuti::where('user_id', $nilai->id)->where('periode_id',$periode))->count() ?: 0;
        $dinlurCount = optional(Dinlur::where('user_id', $nilai->id)->where('periode_id',$periode))->count() ?: 0;
        $datangQrCodeCount = optional(DatangQrCode::where('user_id', $nilai->id)->where('periode_id',$periode))->count() ?: 0;

        $totalCount = $dinlurCount + $datangQrCodeCount;
        // dd($totalCount);


        // dd($dataNilai);
        return view('kasubag.penilaianPegawai', compact('nilai', 'periode','periodeall', 'dataNilai','dataNilaiB','dataNilaiC','jumlahizin','totalCount','jumlahcuti'));
    }
}
