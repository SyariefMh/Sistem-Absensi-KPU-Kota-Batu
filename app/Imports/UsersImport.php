<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Cek jika nilai 'nip' adalah "-"
        $nip = $row[4] !== '-' ? $row[4] : null;
        // Cek apakah 'nip' sudah ada di database
        $existingUser = User::where('nip', $nip)->exists();
        
        // Jika 'nip' sudah ada, kembalikan null agar tidak disimpan
        if ($existingUser) {
            return null;
        }

        return new User([
            'name' => $row[0],
            'password' => bcrypt($row[1]),
            'role' => $row[2],
            'jabatan' => $row[3],
            'nip' => $nip,
        ]);
    }
}
