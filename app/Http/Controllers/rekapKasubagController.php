<?php

namespace App\Http\Controllers;

use App\Models\cuti;
use App\Models\datangQrCode;
use App\Models\dinlur;
use App\Models\izin;
use App\Models\periode;
use App\Models\pulangQrCode;
use App\Models\qrcodeGen;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class rekapKasubagController extends Controller
{
    public function index()
    {

        return view('kasubag.cekRekapKasubag');
    }

    public function rekapPNS()
    {
        $periode = periode::where('status', 1)->pluck('id')->first();
        $users = User::where('jabatan', 'PNS')->get();
        $userIds = $users->pluck('id');

        $cuti = Cuti::whereIn('user_id', $userIds)
            ->select(['id', 'user_id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan', 'Status', 'periode_id'])
            ->addSelect(DB::raw('"Cuti" as source'));

        $izins = Izin::whereIn('user_id', $userIds)
            ->select(['id', 'user_id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan', 'Status', 'periode_id'])
            ->addSelect(DB::raw('"Izin" as source'));

        $dinlur = Dinlur::whereIn('user_id', $userIds)
            ->select(['id', 'user_id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan', 'Status', 'periode_id'])
            ->addSelect(DB::raw('"Dinlur" as source'));

        $qrcode = datangQrCode::whereIn('user_id', $userIds)
            ->select(['id', 'user_id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan', 'Status', 'periode_id'])
            ->addSelect(DB::raw('"QrCode" as source'));

        // $qrcodes = pulangQrCode::whereIn('user_id', $userIds)
        //     ->select(['id', 'user_id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan', 'Status', 'periode_id'])
        //     ->addSelect(DB::raw('"QrCode" as source'));

        $combinedData = $cuti->union($izins)->union($dinlur)->union($qrcode)->where('periode_id', $periode)->get();
        if (request()->tgl == '') {
            return DataTables::of($combinedData)
                ->addColumn('DT_RowIndex', function ($data) {
                    static $index = 0;
                    return ++$index;
                })
                ->addColumn('name', function ($data) {
                    return $data->user->name; // Assuming there's a relationship between models
                })
                ->addColumn('jabatan', function ($data) {
                    return $data->user->jabatan; // Assuming there's a relationship between models
                })
                ->addColumn('action', function ($row) {
                    $showUrl = url('/dashboardKasubag/cekRekap/show?id=' . $row->id . '&kode_absen=' . $row->source);
                    return '<a href="' . $showUrl . '">Show</a>';
                })
                ->toJson();
        }

        $data = $combinedData->where('tanggal', request()->tgl);

        return DataTables::of($data)
            ->addColumn('DT_RowIndex', function ($data) {
                static $index = 0;
                return ++$index;
            })
            ->addColumn('name', function ($data) {
                return $data->user->name; // Assuming there's a relationship between models
            })
            ->addColumn('jabatan', function ($data) {
                return $data->user->jabatan; // Assuming there's a relationship between models
            })
            ->addColumn('action', function ($row) {
                $showUrl = url('/dashboardKasubag/cekRekap/show?id=' . $row->id . '&kode_absen=' . $row->source);
                return '<a href="' . $showUrl . '">Show</a>';
            })
            ->toJson();
    }


    public function rekapSatpam()
    {
        $users = User::where('jabatan', 'Satpam')->get();
        $userIds = $users->pluck('id');

        $userIds = $users->pluck('id');
        $cuti = Cuti::whereIn('user_id', $userIds)
            ->select(['id', 'user_id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan', 'Status'])
            ->addSelect(DB::raw('"Cuti" as source'));

        $izins = Izin::whereIn('user_id', $userIds)
            ->select(['id', 'user_id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan', 'Status'])
            ->addSelect(DB::raw('"Izin" as source'));

        $dinlur = Dinlur::whereIn('user_id', $userIds)
            ->select(['id', 'user_id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan', 'Status'])
            ->addSelect(DB::raw('"Dinlur" as source'));

        $qrcode = datangQrCode::whereIn('user_id', $userIds)
            ->select(['id', 'user_id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan', 'Status'])
            ->addSelect(DB::raw('"QrCode" as source'));

        $combinedData = $cuti->union($izins)->union($dinlur)->union($qrcode)->get();
        // dd($combinedData);

        if (request()->tgl == '') {
            return DataTables::of($combinedData)
                ->addColumn('DT_RowIndex', function ($data) {
                    static $index = 0;
                    return ++$index;
                })
                ->addColumn('name', function ($data) {
                    return $data->user->name; // Assuming there's a relationship between models
                })
                ->addColumn('jabatan', function ($data) {
                    return $data->user->jabatan; // Assuming there's a relationship between models
                })
                ->addColumn('action', function ($row) {
                    $showUrl = url('/dashboardKasubag/cekRekap/show?id=' . $row->id . '&kode_absen=' . $row->source);
                    return '<a href="' . $showUrl . '">Show</a>';
                })
                ->toJson();
        }

        // Jika ada tanggal yang dipilih, filter data sesuai tanggal yang dipilih
        $data = $combinedData->where('tanggal', request()->tgl);

        return DataTables::of($data)
            ->addColumn('DT_RowIndex', function ($data) {
                static $index = 0;
                return ++$index;
            })
            ->addColumn('name', function ($data) {
                return $data->user->name; // Assuming there's a relationship between models
            })
            ->addColumn('jabatan', function ($data) {
                return $data->user->jabatan; // Assuming there's a relationship between models
            })
            ->addColumn('action', function ($row) {
                $showUrl = url('/dashboardKasubag/cekRekap/show?id=' . $row->id . '&kode_absen=' . $row->source);
                return '<a href="' . $showUrl . '">Show</a>';
            })
            ->toJson();
    }


    public function rekapPPNPN()
    {
        $users = User::where('jabatan', 'PPNPN')->get();
        $userIds = $users->pluck('id');
        $cuti = Cuti::whereIn('user_id', $userIds)
            ->select(['id', 'user_id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan', 'Status'])
            ->addSelect(DB::raw('"Cuti" as source'));

        $izins = Izin::whereIn('user_id', $userIds)
            ->select(['id', 'user_id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan', 'Status'])
            ->addSelect(DB::raw('"Izin" as source'));

        $dinlur = Dinlur::whereIn('user_id', $userIds)
            ->select(['id', 'user_id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan', 'Status'])
            ->addSelect(DB::raw('"Dinlur" as source'));

        $qrcode = datangQrCode::whereIn('user_id', $userIds)
            ->select(['id', 'user_id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan', 'Status'])
            ->addSelect(DB::raw('"QrCode" as source'));

        $combinedData = $cuti->union($izins)->union($dinlur)->union($qrcode)->get();


        if (request()->tgl == '') {
            return DataTables::of($combinedData)
                ->addColumn('DT_RowIndex', function ($data) {
                    static $index = 0;
                    return ++$index;
                })
                ->addColumn('name', function ($data) {
                    return $data->user->name; // Assuming there's a relationship between models
                })
                ->addColumn('jabatan', function ($data) {
                    return $data->user->jabatan; // Assuming there's a relationship between models
                })
                ->addColumn('action', function ($row) {
                    $showUrl = url('/dashboardKasubag/cekRekap/show?id=' . $row->id . '&kode_absen=' . $row->source);
                    return '<a href="' . $showUrl . '">Show</a>';
                })
                ->toJson();
        }

        // Jika ada tanggal yang dipilih, filter data sesuai tanggal yang dipilih
        $data = $combinedData->where('tanggal', request()->tgl);

        return DataTables::of($data)
            ->addColumn('DT_RowIndex', function ($data) {
                static $index = 0;
                return ++$index;
            })
            ->addColumn('name', function ($data) {
                return $data->user->name; // Assuming there's a relationship between models
            })
            ->addColumn('jabatan', function ($data) {
                return $data->user->jabatan; // Assuming there's a relationship between models
            })
            ->addColumn('action', function ($row) {
                $showUrl = url('/dashboardKasubag/cekRekap/show?id=' . $row->id . '&kode_absen=' . $row->source);
                return '<a href="' . $showUrl . '">Show</a>';
            })
            ->toJson();
    }

    public function show(Request $request)
    {
        $id = $request->query('id');
        $kode_absen = $request->query('kode_absen');

        if ($kode_absen == 'Cuti') {
            $data = Cuti::with('user')->find($id);
        } elseif ($kode_absen == 'Izin') {
            $data = Izin::with('user')->find($id);
        } elseif ($kode_absen == 'Dinlur') {
            $data = Dinlur::with('user')->find($id);
        } elseif ($kode_absen == 'QrCode') {
            // Anda mungkin perlu menentukan apakah ini untuk datang atau pulang
            // Misalnya, untuk sekarang menggunakan datangQrCode
            $data = datangQrCode::with('user')->find($id);
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan atau kode absen tidak valid.');
        }

        return view('kasubag.showCekRekapKasubag', ['data' => $data]);
    }
}
