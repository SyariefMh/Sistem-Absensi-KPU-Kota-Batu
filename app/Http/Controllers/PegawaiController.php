<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\qrcodeGen;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PegawaiController extends Controller
{
    function index()
    {
        $users = Auth::user();
        return view('Pegawai.dashboardPegawai', compact('users'));
        // echo "<a href='logout'> Logout >> </a>";
    }
    function admin()
    {
        $user = User::where('role', 'pegawai')->get();
        // dd($user);
        return view('dashboardAdmin');
        // echo "<a href='logout'> Logout >> </a>";
    }
    function kasubag()
    {
        return view('kasubag.dashboardKasubag');
        // echo "<a href='logout'> Logout >> </a>";
    }
    // public function update(Request $request)
    // {
    //     // Validasi data
    //     $request->validate([
    //         'name' => 'required',
    //         'role' => ['required', Rule::in(['pegawai', 'admin', 'kasubag umum'])],
    //         'jabatan' => ['nullable', 'string', Rule::in(['PNS', 'PPNPN', 'Satpam'])],
    //         'nip' => 'nullable',
    //         'pangkat' => 'nullable',
    //         'golongan' => 'nullable',
    //         'tandatanggan' => 'nullable|file|mimes:jpeg,png,pdf|max:10000' // Sesuaikan jenis file yang diizinkan dan ukuran maksimum
    //     ]);

    //     // Ambil user yang sedang login
    //     $user = Auth::user();

    //     // Update data user
    //     $user->update($request->only(['name', 'role', 'jabatan', 'nip', 'pangkat', 'golongan']));

    //     // Update password jika password baru disediakan
    //     if ($request->filled('password')) {
    //         $user->password = bcrypt($request->password);
    //     }

    //     // Update tandatangan jika file baru disediakan
    //     if ($request->hasFile('tandatanggan')) {
    //         $tandatanganPath = $request->file('tandatanggan')->store('tandatanggan', 'public');

    //         // Hapus tandatangan yang ada jika ada
    //         if ($user->tandatanggan) {
    //             Storage::disk('public')->delete($user->tandatanggan);
    //         }

    //         $user->tandatanggan = $tandatanganPath;
    //     }

    //     // Simpan perubahan
    //     $user->save();

    //     // Redirect ke dashboardPegawai setelah berhasil
    //     return redirect('/dashboardPegawai')->with('success', 'Data Pegawai Berhasil Diperbarui');
    // }

    public function update(Request $request, $id)
    {
        // dd($request->all()); // Tambahkan ini untuk debugging

        // Validasi data
        $request->validate([
            'name' => 'required',
            'password' => 'nullable|min:6',
            'role' => ['required', Rule::in(['pegawai', 'admin', 'kasubag umum'])],
            'jabatan' => ['nullable', 'string', Rule::in(['PNS', 'PPNPN', 'Satpam'])],
            'nip' => 'nullable',
            'pangkat' => 'nullable',
            'golongan' => 'nullable',
            'tandatanggan' => 'nullable|file|mimes:jpeg,png,pdf|max:10000'
        ]);

        // Ambil user yang sedang login
        $user = User::find($id);

        // Update data user
        $user->update($request->only(['name', 'role', 'jabatan', 'nip', 'pangkat', 'golongan']));

        // Update password jika password baru disediakan
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Update tandatangan jika file baru disediakan
        if ($request->hasFile('tandatanggan')) {
            $tandatanganPath = $request->file('tandatanggan')->store('tandatanggan', 'public');

            // Hapus tandatangan yang ada jika ada
            if ($user->tandatanggan) {
                Storage::disk('public')->delete($user->tandatanggan);
            }

            $user->tandatanggan = $tandatanganPath;
        }

        // Simpan perubahan
        $user->save();

        // Redirect ke dashboardPegawai setelah berhasil
        return response()->json([
            'success' => true,
            'message' => 'Data Pegawai Berhasil Diperbarui',
        ]);
    }

    public function qrcodedatang()
    {
        // Temukan pengguna dengan ID yang diberikan
        $user = auth()->user();;

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
            return response()->json(['redirect' => url('/dashboardPegawai/codePegawai'), 'qrcode' => $existingRecord], 200);
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

    public function qrcodepulang()
    {
        $user = Auth::user();
        $userId = $user->id;
        $tanggal = now()->toDateString();

        // Cek apakah sudah ada QR code dengan tanggal yang sama
        $existingRecord = qrcodeGen::where('user_id', $userId)
            ->whereDate('tanggal', $tanggal)
            ->first();
        // dd($existingRecord);
        if ($existingRecord) {
            // dd($existingRecord->tanggal==$tanggal);
            if ($existingRecord->tanggal == $tanggal && $existingRecord->qrcode_pulang) {
                // Jika sudah ada QR code untuk tanggal hari ini, kembalikan record yang ada
                return response()->json(['message' => 'QR Code Pulang sudah ada', 'redirect' => true]);
            } else {
                if (!$existingRecord->qrcode_datang) {
                    return response()->json(['message' => 'QR Code datang tidak ada', 'redirect' => false]);
                }
                $code = 'PLG' . Str::random(8);
                $qrCodeData = $code;
                $qrCode = QrCode::format('png')->size(200)->generate($qrCodeData);
                $qrCodePathPulang = 'qrcodesPlg/' . $qrCodeData . '.png';
                Storage::disk('public')->put($qrCodePathPulang, $qrCode);

                // Simpan QR code baru
                qrcodeGen::updateOrCreate(
                    ['user_id' => $userId, 'tanggal' => $tanggal],
                    [
                        'qrcode_pulang' => $qrCodeData,
                        'qrcodefilesPlg' => $qrCodePathPulang,
                        'tanggal_kirimPlg' => $tanggal,
                    ]
                );

                return response()->json(['message' => 'QR Code Pulang berhasil dikirim ke ' . $user->name, 'redirect' => true]);
            }
        } else {
            // Jika belum ada, buat QR code baru untuk tanggal hari ini
            $code = 'PLG' . Str::random(8);
            $qrCodeData = $code;
            $qrCode = QrCode::format('png')->size(200)->generate($qrCodeData);
            $qrCodePathPulang = 'qrcodesPlg/' . $qrCodeData . '.png';
            Storage::disk('public')->put($qrCodePathPulang, $qrCode);

            // Simpan QR code baru
            qrcodeGen::create([
                'user_id' => $userId,
                'qrcode_pulang' => $qrCodeData,
                'qrcodefilesPlg' => $qrCodePathPulang,
                'tanggal' => $tanggal,
                'tanggal_kirimPlg' => $tanggal,
            ]);

            return response()->json(['message' => 'QR Code Pulang berhasil dikirim ke ' . $user->name, 'redirect' => true]);
        }

        return response()->json(['message' => 'Tidak bisa membuat QR code baru karena tanggal berbeda dengan tanggal sekarang.'], 400);
    }




    public function handleQrCodeRequest(Request $request)
    {
        // Lakukan operasi yang diperlukan, misalnya pengambilan data dari database atau pemrosesan lainnya.

        // Simpan user ID dalam session atau cookie
        session(['active_user_id' => auth()->user()->id]);

        // Kirim respons JSON kembali ke frontend
        return response()->json(['success' => 'QR code request processed successfully']);
    }
}
