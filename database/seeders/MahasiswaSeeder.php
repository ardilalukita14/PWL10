<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mahasiswa')-> insert([
            [
                'Nim' => '1941720098',
                'Nama' => 'Andien Karmila',
                'Tanggal_Lahir' => '2001-08-18',
                'Kelas' => 'AK-3B',
                'Jurusan' => 'Teknologi Informasi',
                'Email' => 'karmilandin23@gmail.com',
                'No_Handphone' => '085671092328'
            ],
            [
                'Nim' => '2078906775',
                'Nama' => 'Windha ayu',
                'Tanggal_Lahir' => '1999-11-13',
                'Kelas' => 'TI-4D',
                'Jurusan' => 'Teknologi Informasi',
                'Email' => 'wirdada1@gmail.com',
                'No_Handphone' => '082567809322'
            ],
            [
                'Nim' => '1941720040',
                'Nama' => 'Ahmad Danu',
                'Tanggal_Lahir' => '1999-01-15',
                'Kelas' => 'TI-3A',
                'Jurusan' => 'Teknologi Informasi',
                'Email' => 'ahmadanu01@gmail.com',
                'No_Handphone' => '085679032567'
            ],
            [
                'Nim' => '1941890765',
                'Nama' => 'Ifan Kurnia',
                'Tanggal_Lahir' => '2001-09-20',
                'Kelas' => 'AK-2F',
                'Jurusan' => 'Akuntansi',
                'Email' => 'ifankur20@gmail.com',
                'No_Handphone' => '081334567800'
            ]
    ]);
    }
}