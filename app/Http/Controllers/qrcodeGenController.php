<?php

namespace App\Http\Controllers;

use App\Models\qrcodeGen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class qrcodeGenController extends Controller
{
    public  function index()
    {
        return view('codePegawai');
    }

    public function qrcodedatang(string $id)
    {
        // Temukan pengguna dengan ID yang diberikan
        $user = User::findOrFail($id);

        // Pastikan pengguna ditemukan dan memiliki peran 'karyawan'
        if ($user && $user->role === 'pegawai') {
            // Hapus QR code datang yang lama jika ada
            // $existingQrCode = QrCode::where('user_id', $user->id)->where('code', 'datang')->first();
            // if ($existingQrCode) {
            //     Storage::delete($existingQrCode->qr_code);
            //     $existingQrCode->delete();
            // }

            // Generate kode unik untuk QR code
            // $code = 'ID' . $user->id . '_' . Str::slug($user->name) . '_' . Str::slug($user->email) . '_' . Str::random(3);
            $code = 'ATTDN' . Str::random(8);

            // Generate QR Code datang dengan informasi yang sesuai (misalnya, kode unik)
            $qrCodeData = $code;
            $qrCode = QrCode::format('png')->size(200)->generate($qrCodeData);

            // Simpan QR Code datang ke dalam penyimpanan yang dapat diakses oleh pengguna
            $qrCodePathDatang = 'qrcodes/' . $qrCodeData . '.png';
            Storage::disk('public')->put($qrCodePathDatang, $qrCode);

            // Simpan informasi QR code ke dalam database
            qrcodeGen::create([
                'user_id' => $user->id,
                'tanggal' => now()->toDateString(),
                'qrcode_datang' => $qrCodeData,
                'qrcodefilesDtg' => $qrCodePathDatang,
            ]);

            // Jika QR Code berhasil dikirim, kembalikan respons sukses dalam format JSON
            return response()->json(['message' => 'QR Code Datang berhasil dikirim ke ' . $user->name]);
        }
    }

    public function qrcodepulang(string $id)
    {
        // Temukan pengguna dengan ID yang diberikan
        $user = User::findOrFail($id);

        // Pastikan pengguna ditemukan dan memiliki peran 'karyawan'
        if ($user && $user->role === 'karyawan') {
            // Generate kode unik untuk QR code
            $code = 'ATTDNP' . Str::random(6);

            // Generate QR Code pulang dengan informasi yang sesuai (misalnya, kode unik)
            $qrCodeData = $code;
            $qrCode = QrCode::format('png')->size(200)->generate($qrCodeData);

            // Simpan QR Code pulang ke dalam penyimpanan yang dapat diakses oleh pengguna
            $qrCodePathPulang = 'qrcodes/' . $qrCodeData . '.png';
            Storage::disk('public')->put($qrCodePathPulang, $qrCode);

            // Perbarui informasi QR code di database jika sudah ada, jika tidak, buat entri baru
            $qrCodeGen = QrCodeGen::where('user_id', $user->id)->first();
            if ($qrCodeGen) {
                $qrCodeGen->update([
                    'qrcode_pulang' => $qrCodeData,
                    'qrcodefilesPlg' => $qrCodePathPulang,
                ]);
            } else {
                QrCodeGen::create([
                    'user_id' => $user->id,
                    'qrcode_pulang' => $qrCodeData,
                    'qrcodefilesPlg' => $qrCodePathPulang,
                ]);
            }

            // Jika QR Code berhasil dikirim, kembalikan respons sukses dalam format JSON
            return response()->json(['message' => 'QR Code Pulang berhasil dikirim ke ' . $user->name]);
        }

        // Jika pengguna tidak ditemukan atau bukan karyawan, kembalikan respons gagal dalam format JSON
        return response()->json(['error' => 'Gagal mengirim QR Code Pulang. Pengguna tidak ditemukan atau bukan karyawan.'], 404);
    }

    public function indexKaryawan()
    {
        // Controller method
        $user = auth()->user();
        $qrcodeGens = qrcodeGen::where('user_id', $user->id)->get();
        // Pass the variable as 'qrcodefilesDtg' to the view
        return view('codePegawai', ['qrcodefilesDtg' => $qrcodeGens]);
    }
}
