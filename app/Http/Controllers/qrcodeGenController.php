<?php

namespace App\Http\Controllers;

use App\Models\cuti;
use App\Models\dinlur;
use App\Models\izin;
use App\Models\qrcodeGen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class qrcodeGenController extends Controller
{
    public  function index()
    {
        return view('codePegawai');
    }

    public function qrcodeupstat(Request $request, $id)
    {
        // Dapatkan ID pengguna yang terautentikasi
        $userId = auth()->id();

        // Temukan pengguna dengan ID yang diberikan
        $user = User::find($userId);

        // Pastikan pengguna ditemukan dan memiliki peran 'pegawai'
        if ($user && $user->role === 'pegawai') {
            // Temukan record QR Code yang ingin diupdate
            $qrCode = qrcodeGen::find($id);


            // Pastikan record ditemukan
            if (!$qrCode) {
                return response()->json(['error' => 'QR Code not found'], 404);
            }

            // Hapus record QR Code
            $qrCode->delete();

            // Jika QR Code berhasil dihapus, kembalikan respons sukses dalam format JSON
            return response()->json(['success' => 'QR Code Datang berhasil dihapus'], 200);
        }

        // Jika pengguna tidak terautentikasi atau tidak memiliki peran 'pegawai', kembalikan respons error
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    // public function qrcodedatanggenul(string $id)
    // {
    //     $user = User::findOrFail($id);

    //     // Pastikan pengguna ditemukan
    //     if (!$user) {
    //         return response()->json(['error' => 'Pengguna tidak ditemukan'], 404);
    //     }

    //     // Pastikan pengguna memiliki peran 'pegawai'
    //     if ($user->role !== 'pegawai') {
    //         return response()->json(['error' => 'Pengguna bukan memiliki peran pegawai'], 403);
    //     }
    //     // Check if a record already exists for the same user ID and date
    //     $existingRecord = qrcodeGen::where('user_id', $user->id)
    //         ->whereDate('tanggal_kirimDtg', now()->toDateString())
    //         ->exists();

    //     // If a record already exists, return an error response
    //     if ($existingRecord) {
    //         return response()->json(['error' => 'QR Code for today already sent by ' . $user->name], 422);
    //     }

    //     // Generate kode unik untuk QR code
    //     $code = 'ATTDN' . Str::random(8);

    //     // Generate QR Code datang dengan informasi yang sesuai (misalnya, kode unik)
    //     $qrCodeData = $code;
    //     $qrCode = QrCode::format('png')->size(200)->generate($qrCodeData);

    //     // Simpan QR Code datang ke dalam penyimpanan yang dapat diakses oleh pengguna
    //     $qrCodePathDatang = 'qrcodes/' . $qrCodeData . '.png';
    //     Storage::disk('public')->put($qrCodePathDatang, $qrCode);

    //     // Simpan informasi QR code ke dalam database
    //     qrcodeGen::create([
    //         'user_id' => auth()->id(),
    //         'tanggal' => now()->toDateString(),
    //         'tanggal_kirimDtg' => now()->toDateString(),
    //         'status' => 1,
    //         'qrcode_datang' => $qrCodeData,
    //         'qrcodefilesDtg' => $qrCodePathDatang,
    //     ]);

    //     // Jika QR Code berhasil dikirim, kembalikan respons sukses dalam format JSON
    //     return response()->json(['success' => 'QR Code Datang berhasil dikirim ke ' . $user->name], 200);
    // }
    public function qrcodedatanggenul()
    {
        $user = auth()->user(); // Mengambil pengguna yang sedang diotentikasi

        // Pastikan pengguna ditemukan
        if (!$user) {
            return response()->json(['error' => 'Pengguna tidak ditemukan'], 404);
        }

        // Pastikan pengguna memiliki peran 'pegawai'
        if ($user->role !== 'pegawai') {
            return response()->json(['error' => 'Pengguna bukan memiliki peran pegawai'], 403);
        }

        // Check if a record already exists for the same user ID and date
        $existingRecord = qrcodeGen::where('user_id', $user->id)
            ->whereDate('tanggal_kirimDtg', now()->toDateString())
            ->exists();

        // If a record already exists, return an error response
        if ($existingRecord) {
            return response()->json(['error' => 'QR Code for today already sent by ' . $user->name], 422);
        }

        // Generate kode unik untuk QR code
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
            'tanggal_kirimDtg' => now()->toDateString(),
            'status' => 1,
            'qrcode_datang' => $qrCodeData,
            'qrcodefilesDtg' => $qrCodePathDatang,
        ]);

        // Jika QR Code berhasil dikirim, kembalikan respons sukses dalam format JSON
        return response()->json(['success' => 'QR Code Datang berhasil dikirim ke ' . $user->name], 200);
    }


    // public function qrcodedatang(string $id)
    // {
    //     // Temukan pengguna dengan ID yang diberikan
    //     $user = User::findOrFail($id);

    //     // Pastikan pengguna ditemukan dan memiliki peran 'pegawai'
    //     if ($user && $user->role === 'pegawai') {
    //         // Periksa apakah sudah pukul 07.00 WIB
    //         $now = now()->format('H:i');
    //         // dd($now);
    //         if ($now !== '04:17') {
    //             return response()->json(['error' => 'QR Code dapat dikirim hanya pada pukul 10:39 WIB'], 422);
    //         }

    //         // Check if a record already exists for the same user ID and date
    //         $existingRecord = qrcodeGen::where('user_id', $user->id)
    //             ->whereDate('tanggal_kirimDtg', now()->toDateString())
    //             ->exists();

    //         // If a record already exists, return an error response
    //         if ($existingRecord) {
    //             return response()->json(['error' => 'QR Code for today already sent by ' . $user->name], 422);
    //         }

    //         // Generate kode unik untuk QR code
    //         $code = 'ATTDN' . Str::random(8);

    //         // Generate QR Code datang dengan informasi yang sesuai (misalnya, kode unik)
    //         $qrCodeData = $code;
    //         $qrCode = QrCode::format('png')->size(200)->generate($qrCodeData);

    //         // Simpan QR Code datang ke dalam penyimpanan yang dapat diakses oleh pengguna
    //         $qrCodePathDatang = 'qrcodes/' . $qrCodeData . '.png';
    //         Storage::disk('public')->put($qrCodePathDatang, $qrCode);

    //         // Simpan informasi QR code ke dalam database
    //         qrcodeGen::create([
    //             'user_id' => $user->id,
    //             'tanggal' => now()->toDateString(),
    //             'tanggal_kirimDtg' => now()->toDateString(),
    //             'status' => 1,
    //             'qrcode_datang' => $qrCodeData,
    //             'qrcodefilesDtg' => $qrCodePathDatang,
    //         ]);

    //         // Jika QR Code berhasil dikirim, kembalikan respons sukses dalam format JSON
    //         return response()->json(['success' => 'QR Code Datang berhasil dikirim ke ' . $user->name], 200);
    //     }
    // }
    public function qrcodedatang(string $id)
    {
        // Temukan pengguna dengan ID yang diberikan
        $user = User::findOrFail($id);

        // Pastikan pengguna ditemukan
        if (!$user) {
            return response()->json(['error' => 'Pengguna tidak ditemukan'], 404);
        }

        // Pastikan pengguna memiliki peran 'pegawai'
        if ($user->role !== 'pegawai') {
            return response()->json(['error' => 'Pengguna bukan memiliki peran pegawai'], 403);
        }

        // Periksa apakah sudah pukul 07.00 WIB
        $now = now()->format('H:i');
        if ($now !== '08:07') {
            return response()->json(['error' => 'QR Code dapat dikirim hanya pada pukul 10:39 WIB'], 422);
        }

        // Check if a record already exists for the same user ID and date
        $existingRecord = qrcodeGen::where('user_id', $user->id)
            ->whereDate('tanggal_kirimDtg', now()->toDateString())
            ->exists();

        // If a record already exists, return an error response
        if ($existingRecord) {
            return response()->json(['error' => 'QR Code for today already sent by ' . $user->name], 422);
        }

        // Generate kode unik untuk QR code
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
            'tanggal_kirimDtg' => now()->toDateString(),
            'status' => 1,
            'qrcode_datang' => $qrCodeData,
            'qrcodefilesDtg' => $qrCodePathDatang,
        ]);

        // Jika QR Code berhasil dikirim, kembalikan respons sukses dalam format JSON
        return response()->json(['success' => 'QR Code Datang berhasil dikirim ke ' . $user->name], 200);
    }
    public function sendQRCodeToAllEmployees()
    {
        // Ambil semua pengguna dengan role 'pegawai'
        $pegawaiUsers = User::where('role', 'pegawai')->get();

        // Loop through each user and send QR code
        foreach ($pegawaiUsers as $user) {
            // Check if a record already exists for the same user ID and date
            $existingRecord = qrcodeGen::where('user_id', $user->id)
                ->whereDate('tanggal_kirimDtg', now()->toDateString())
                ->exists();

            // If a record already exists, skip sending QR code
            if ($existingRecord) {
                continue;
            }

            // Generate kode unik untuk QR code
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
                'tanggal_kirimDtg' => now()->toDateString(),
                'status' => 1,
                'qrcode_datang' => $qrCodeData,
                'qrcodefilesDtg' => $qrCodePathDatang,
            ]);
        }

        // Jika QR Code berhasil dikirim kepada semua pegawai, kembalikan respons sukses dalam format JSON
        return response()->json(['success' => 'QR Code Datang berhasil dikirim kepada semua pegawai'], 200);
    }
    public function sendQRPulangCodeToAllEmployees()
    {
        // Ambil semua pengguna dengan role 'pegawai'
        $pegawaiUsers = User::where('role', 'pegawai')->get();

        // Loop through each user and send QR code
        foreach ($pegawaiUsers as $user) {
            // Check if a record already exists for the same user ID and date
            $existingRecord = qrcodeGen::where('user_id', $user->id)
                ->whereDate('tanggal_kirimPlg', now()->toDateString())
                ->exists();

            // If a record already exists, skip sending QR code
            if ($existingRecord) {
                continue;
            }

            // Generate kode unik untuk QR code
            $code = 'PLG' . Str::random(8);

            // Generate QR Code pulang dengan informasi yang sesuai (misalnya, kode unik)
            $qrCodeData = $code;
            $qrCode = QrCode::format('png')->size(200)->generate($qrCodeData);

            // Simpan QR Code pulang ke dalam penyimpanan yang dapat diakses oleh pengguna
            $qrCodePathPulang = 'qrcodesPlg/' . $qrCodeData . '.png';
            Storage::disk('public')->put($qrCodePathPulang, $qrCode);

            $qrcodeExistingRecord = qrcodeGen::where('user_id', $user->id)
                ->whereDate('tanggal_kirimDtg', now()->toDateString())
                ->first();
            if ($qrcodeExistingRecord) {
                $qrcodeExistingRecord->update([
                    'qrcode_pulang' => $qrCodeData,
                    'qrcodefilesPlg' => $qrCodePathPulang,
                    'tanggal_kirimPlg' => now()->toDateString(),
                ]);
            } else {
                return response()->json(['error' => 'maaf belum bisa mengirimkan qrcode pulang'], 422);
            }
            // Perbarui informasi QR code di database jika sudah ada
            // qrcodeGen::where('user_id', $user->id)
            //     ->whereDate('tanggal_kirimDtg', now()->toDateString())
            //     ->update([
            //         'qrcode_pulang' => $qrCodeData,
            //         'qrcodefilesPlg' => $qrCodePathPulang,
            //         'tanggal_kirimPlg' => now()->toDateString(),
            //     ]);
        }

        // Jika QR Code berhasil dikirim kepada semua pegawai, kembalikan respons sukses dalam format JSON
        return response()->json(['success' => 'QR Code Pulang berhasil dikirim kepada semua pegawai'], 200);
    }




    public function qrcodepulang(string $id)
    {
        // Temukan pengguna dengan ID yang diberikan
        $user = User::findOrFail($id);

        // Pastikan pengguna ditemukan dan memiliki peran 'karyawan'
        if ($user && $user->role === 'pegawai') {
            // Check if a record already exists for the same user ID and date
            $existingRecord = qrcodeGen::where('user_id', $user->id)
                ->whereDate('tanggal_kirimPlg', now()->toDateString())
                ->exists();

            // If a record already exists, return an error response
            if ($existingRecord) {
                return response()->json(['error' => 'QR Code for today already sent by ' . $user->name], 422);
            }
            // Generate kode unik untuk QR code
            $code = 'PLG' . Str::random(8);

            // Generate QR Code pulang dengan informasi yang sesuai (misalnya, kode unik)
            $qrCodeData = $code;
            $qrCode = QrCode::format('png')->size(200)->generate($qrCodeData);

            // Simpan QR Code pulang ke dalam penyimpanan yang dapat diakses oleh pengguna
            $qrCodePathPulang = 'qrcodesPlg/' . $qrCodeData . '.png';
            Storage::disk('public')->put($qrCodePathPulang, $qrCode);

            // Perbarui informasi QR code di database jika sudah ada, jika tidak, buat entri baru
            $qrCodeGen = QrCodeGen::where('user_id', $user->id)->first();
            if ($qrCodeGen) {
                $qrCodeGen->update([
                    'qrcode_pulang' => $qrCodeData,
                    'qrcodefilesPlg' => $qrCodePathPulang,
                    'tanggal_kirimPlg' => now()->toDateString(),
                ]);
            } else {
                QrCodeGen::create([
                    'user_id' => $user->id,
                    'qrcode_pulang' => $qrCodeData,
                    'qrcodefilesPlg' => $qrCodePathPulang,
                    'tanggal_kirimPlg' => now()->toDateString(),
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
        $user = Auth::user();
        $userId = $user->id; // Retrieve the user ID

        // Retrieve records for cuti and izin models for the logged-in user
        $cuti = cuti::where('user_id', $userId)->pluck('tanggal')->toArray();
        $dinlur = dinlur::where('user_id', $userId)->pluck('tanggal')->toArray();
        $izins = Izin::where('user_id', $userId)->pluck('tanggal')->toArray();

        // Combine the dates of cuti, izin, and qrcode records
        $combinedDates = collect($cuti)->merge($dinlur)->merge($izins)->unique();



        // Check if there are any records for cuti or izin on today's date
        $today = now()->toDateString();
        $absensiDisabled = $combinedDates->contains($today);

        if ($absensiDisabled) {
            return redirect('dashboardPegawai')->withErrors('Sudah Absen');
        }
        // Controller method
        $user = auth()->user();
        $today = now()->format('Y-m-d');
        $qrcodeGens = qrcodeGen::where('tanggal_kirimDtg', $today)
            ->where('user_id', $user->id)->first();
        // handle qr code null
        if ($qrcodeGens  == null) {
            return redirect('dashboardPegawai')->withErrors('Qr code Belum dikirim segera ke Admin!!!');
        }
        $id = $qrcodeGens->id;
        return view('Pegawai.codePegawai', ['qrcodefilesDtg' => $qrcodeGens, 'id' => $id]);
    }

    public function indexKaryawanPulang()
    {
        $user = Auth::user();
        $userId = $user->id; // Retrieve the user ID

        // Retrieve records for cuti and izin models for the logged-in user
        $cuti = cuti::where('user_id', $userId)->pluck('tanggal')->toArray();
        $dinlur = dinlur::where('user_id', $userId)->pluck('tanggal')->toArray();
        $izins = Izin::where('user_id', $userId)->pluck('tanggal')->toArray();

        // Combine the dates of cuti, izin, and qrcode records
        $combinedDates = collect($cuti)->merge($dinlur)->merge($izins)->unique();



        // Check if there are any records for cuti or izin on today's date
        $today = now()->toDateString();
        $absensiDisabled = $combinedDates->contains($today);

        if ($absensiDisabled) {
            return redirect('dashboardPegawai')->withErrors('Sudah Absen');
        }
        // Controller method
        $user = auth()->user();
        $today = now()->format('Y-m-d');
        $qrcodeGens = qrcodeGen::where('tanggal_kirimPlg', $today)
            ->where('user_id', $user->id)->first();
        // handle null qr code
        if ($qrcodeGens  == null) {
            return redirect('dashboardPegawai')->withErrors('Qr code Belum dikirim segera ke Admin!!!');
        }

        // Pass the variable as 'qrcodefilesDtg' to the view
        return view('Pegawai.codePegawaiPulang', ['qrcodefilesDtg' => $qrcodeGens]);
    }
}
