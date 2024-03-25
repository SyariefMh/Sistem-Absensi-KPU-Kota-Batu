<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\qrcodeGenController;

class SendQRCode extends Command
{
    protected $signature = 'send:qr-code';
    protected $description = 'Kirim QR code secara otomatis pada pukul 23.28 WIB';

    public function handle()
    {
        // Ganti 1 dengan ID pengguna yang ingin Anda kirimkan QR code-nya
        $userId = 1;

        // Instansiasi controller dan panggil metode qrcodedatanggenul
        $controller = new qrcodeGenController();
        $response = $controller->qrcodedatang($userId);

        $this->info($response['message']); // Tampilkan pesan dari respons
    }
}
