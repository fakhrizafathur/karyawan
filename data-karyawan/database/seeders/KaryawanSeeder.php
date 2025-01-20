<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karyawan;

class KaryawanSeeder extends Seeder
{
    public function run()
    {
        Karyawan::create([
            'nama' => 'John Doe',
            'status' => 'aktif',
            'pekerjaan_id' => 1, // Sesuai dengan id di tabel pekerjaans
        ]);

        Karyawan::create([
            'nama' => 'Jane Smith',
            'status' => 'aktif',
            'pekerjaan_id' => 2, // Sesuai dengan id di tabel pekerjaans
        ]);

        Karyawan::create([
            'nama' => 'Alice Johnson',
            'status' => 'nonaktif',
            'pekerjaan_id' => 3, // Sesuai dengan id di tabel pekerjaans
        ]);

        Karyawan::create([
            'nama' => 'Bob Brown',
            'status' => 'aktif',
            'pekerjaan_id' => 4, // Sesuai dengan id di tabel pekerjaans
        ]);
    }
}