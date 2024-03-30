<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\qrcodeGenController;
use App\Models\User;

class SendQRCode extends Command
{
    protected $signature = 'send:qr-code';
    protected $description = 'Kirim QR code secara otomatis pada pukul 10:39 WIB';

    public function handle()
    {
        // // Ganti 1 dengan ID pengguna yang ingin Anda kirimkan QR code-nya
        // $userId = 1;
        // Ambil daftar pengguna dengan peran pegawai
        $users = User::where('role', 'pegawai')->get();

        // // Instansiasi controller dan panggil metode qrcodedatanggenul
        // $controller = new qrcodeGenController();
        // $response = $controller->qrcodedatang($userId);

        // $this->info($response['message']); // Tampilkan pesan dari respons
        // Instansiasi controller
        $controller = new qrcodeGenController();

        // Loop untuk mengirim QR code kepada setiap pengguna
        foreach ($users as $user) {
            $response = $controller->qrcodedatang($user->id);
            $this->info("QR code dikirimkan kepada pengguna dengan ID: {$user->id}. Pesan: {$response['message']}");
        }
    }
}
