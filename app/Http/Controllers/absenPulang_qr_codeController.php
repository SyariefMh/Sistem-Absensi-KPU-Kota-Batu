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
    public function scanQrCodeDatang(Request $request)
    {
        $qrCodeData = $request->input('qrcodefilesPlg');
        $qrCodes = qrcodeGen::where('qrcode_pulang', $qrCodeData) // Use $desiredUserId directly as the user ID
            ->first();

        if (!$qrCodes) {
            return response()->json(['error' => 'QR code not found'], 400);
        }


        $qrCodeScan = pulangQrCode::where('qrcode_id', $qrCodes->id)
            ->whereDate('tanggal', now()->toDateString())
            ->exists();

        if ($qrCodeScan) {
            // return redirect('/dashboardkaryawan/Absensi/LiveLocation')->with('error', 'QR Code sudah discan sebelumnya.');
            return response()->json(['message' => 'QR Code sudah discan sebelumnya.'], 400);
        }
        $jamDatang = datangQrCode::get('jam_datang');
        // print_r($jamDatang);
        // dd($jamDatang);
        $userId = $qrCodes->user_id;
        // datangQrCode::updateOrCreate([
        //     'qrcode_id' => $qrCodes->id,
        //     'user_id' => $userId,
        //     'tanggal' => now()->toDateString(),
        //     'jam_pulang' => now()->toTimeString(),
        // ])->where('user_id', $userId);

        // DB::select('update datangqrcode set jam_pulang =? where user_id=? ', [now()->toDateTimeString(), $userId]);
        datangQrCode::where('user_id', $userId)
            ->update(['jam_pulang' => now()->toDateTimeString()]);




        return response()->json(['success' => 'Absensi berhasil dicatat.'], 200);
    }
}
