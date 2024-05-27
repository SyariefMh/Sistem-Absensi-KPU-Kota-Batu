<?php

namespace App\Http\Controllers;

use App\Models\datangQrCode;
use App\Models\pulangQrCode;
use App\Models\qrcodeGen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class absenPulang_qr_codeController extends Controller
{
    public function index()
    {
        return view('codePulangAdmin');
    }
    public function indexSatpam()
    {
        return view('satpam.codePulangSatpam');
    }
    public function indexKasubag()
    {
        return view('kasubag.codePulangKasubag');
    }

    public function scanQrCodeDatang(Request $request)
    {
        $qrCodeData = $request->input('qrcodefilesPlg');
        $qrCodes = qrcodeGen::where('qrcode_pulang', $qrCodeData)->first();

        if (!$qrCodes) {
            return response()->json(['error' => 'QR code not found'], 400);
        }

        $today = now()->toDateString();
        $qrCodeScan = datangQrCode::where('qrcode_id', $qrCodes->id)
            ->whereDate('tanggal', $today)
            ->first();

        if ($qrCodeScan) {
            if (!is_null($qrCodeScan->jam_pulang)) {
                return response()->json(['message' => 'QR Code sudah discan sebelumnya atau sudah ada jam pulang.'], 400);
            }
        }

        $userId = $qrCodes->user_id;

        datangQrCode::where('user_id', $userId)
            ->whereDate('tanggal', $today)
            ->update(['jam_pulang' => now()->toDateTimeString()]);

        return response()->json(['success' => 'Absensi berhasil dicatat.'], 200);
    }


    // public function scanQrCodeDatang(Request $request)
    // {
    //     $qrCodeData = $request->input('qrcodefilesPlg');
    //     $qrCodes = qrcodeGen::where('qrcode_pulang', $qrCodeData) // Use $desiredUserId directly as the user ID
    //         ->first();
    //     // dd($qrCodes);
    //     if (!$qrCodes) {
    //         return response()->json(['error' => 'QR code not found'], 400);
    //     }


    //     $qrCodeScan = datangQrCode::where('qrcode_id', $qrCodes->id)
    //         ->whereDate('tanggal', now()->toDateString())
    //         ->first();
    //     // dd($qrCodeScan);
    //     if ($qrCodeScan) {
    //         if (!is_null($qrCodeScan->jam_pulang)) {
    //             return response()->json(['message' => 'QR Code sudah discan sebelumnya atau sudah ada jam pulang.'], 400);
    //         }
    //     }
    //     $jamDatang = datangQrCode::get('jam_datang');
    //     // print_r($jamDatang);
    //     // dd($jamDatang);
    //     $userId = $qrCodes->user_id;
    //     // dd($userId);
    //     // datangQrCode::updateOrCreate([
    //     //     'qrcode_id' => $qrCodes->id,
    //     //     'user_id' => $userId,
    //     //     'tanggal' => now()->toDateString(),
    //     //     'jam_pulang' => now()->toTimeString(),
    //     // ])->where('user_id', $userId);

    //     // DB::select('update datangqrcode set jam_pulang =? where user_id=? ', [now()->toDateTimeString(), $userId]);
    //     datangQrCode::where('user_id', $userId)
    //         ->update(['jam_pulang' => now()->toDateTimeString()]);




    //     return response()->json(['success' => 'Absensi berhasil dicatat.'], 200);
    // }
}
