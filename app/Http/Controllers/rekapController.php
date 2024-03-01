<?php

namespace App\Http\Controllers;

use App\Models\cuti;
use App\Models\datangQrCode;
use App\Models\dinlur;
use App\Models\izin;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class rekapController extends Controller
{
    public function index()
    {
        return view('cekRekap');
    }

    public function rekapPNS()
    {
        $users = User::where('jabatan', 'PNS')->get();
        $userIds = $users->pluck('id');
        $cuti = Cuti::whereIn('user_id', $userIds)
            ->select(['id', 'user_id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan']); // Adjust columns accordingly
        $izins = Izin::whereIn('user_id', $userIds)
            ->select(['id', 'user_id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan']); // Adjust columns accordingly
        $dinlur = Dinlur::whereIn('user_id', $userIds)
            ->select(['id', 'user_id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan']); // Adjust columns accordingly
        $qrcode = datangQrCode::whereIn('qrcode_id', function ($query) use ($userIds) {
            $query->select('id')
                ->from('qrcode_gens')
                ->whereIn('user_id', $userIds);
        })
            ->select(['id', 'qrcode_id', 'tanggal', 'jam_datang', 'jam_pulang', 'Keterangan']);
        // Adjust columns accordingly

        $combinedData = $cuti->union($izins)->union($dinlur)->union($qrcode)->get();

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
            }) // If 'action' column contains HTML
            ->toJson();
    }
}
