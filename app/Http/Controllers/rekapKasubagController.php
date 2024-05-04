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

        $qrcodes = pulangQrCode::whereIn('user_id', $userIds)
            ->select(['id', 'user_id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan', 'Status'])
            ->addSelect(DB::raw('"QrCode" as source'));

        $combinedData = $cuti->union($izins)->union($dinlur)->union($qrcode)->union($qrcodes)->where('periode_id', $periode)->get();

        // Jika tidak ada tanggal yang dipilih, tampilkan semua data
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
                    $showUrl = url('/dashboardAdmin/cekRekap/show/' . $row->id);
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
                $showUrl = url('/dashboardAdmin/cekRekap/show/' . $row->id);
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
                    $showUrl = url('/dashboardAdmin/cekRekap/show/' . $row->id);
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
                $showUrl = url('/dashboardAdmin/cekRekap/show/' . $row->id);
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
                    $showUrl = url('/dashboardAdmin/cekRekap/show/' . $row->id);
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
                $showUrl = url('/dashboardAdmin/cekRekap/show/' . $row->id);
                return '<a href="' . $showUrl . '">Show</a>';
            })
            ->toJson();
    }

    public function show($id)
    {
        $users = User::where('jabatan', 'Jagat Saksana (Satpam)')->get();
        $userIds = $users->pluck('id');
        $users = User::where('jabatan', 'PNS')->get();
        $userIds = $users->pluck('id');
        $users = User::where('jabatan', 'PPNPN')->get();
        $userIds = $users->pluck('id');
        $cutiData = Cuti::find($id);
        $izinData = Izin::find($id);
        $dinlurData = Dinlur::find($id);
        $qrcodeData = datangQrCode::find($id);

        if ($cutiData !== null) {
            $cutiAttributes = $cutiData->toArray();
            return view('showCekRekap', compact('cutiAttributes'));
            // Display data from Cuti
            // Do something with $cutiData
        } elseif ($izinData !== null) {
            $izinAttributes = $izinData->toArray();
            return view('showCekRekap', compact('izinAttributes'));
            // Display data from Izin
            // Do something with $izinData
        } elseif ($dinlurData !== null) {
            $dinlurAttributes = $dinlurData->toArray();
            return view('showCekRekap', compact('dinlurAttributes'));
            // Display data from Dinlur
            // Do something with $dinlurData
        } elseif ($qrcodeData !== null) {
            $qrcodeAttributes = $qrcodeData->toArray();
            return view('showCekRekap', compact('qrcodeAttributes'));
            // Display data from QrCode
            // Do something with $qrcodeData
        } else {
            // Handle case where no data is found
            echo "No data found.";
        }
    }
}
