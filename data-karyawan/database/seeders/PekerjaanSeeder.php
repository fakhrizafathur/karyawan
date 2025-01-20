<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pekerjaan;

class PekerjaanSeeder extends Seeder
{
    public function run()
    {
        Pekerjaan::create(['pekerjaan' => 'Software Engineer', 'divisi' => 'IT']);
        Pekerjaan::create(['pekerjaan' => 'Marketing Specialist', 'divisi' => 'Marketing']);
        Pekerjaan::create(['pekerjaan' => 'HR Manager', 'divisi' => 'Human Resources']);
        Pekerjaan::create(['pekerjaan' => 'Accountant', 'divisi' => 'Finance']);
    }
}
