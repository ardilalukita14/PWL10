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
                'kelas_id' => '29',
                'Jurusan' => 'Teknologi Informasi',
                'Email' => 'karmilandin23@gmail.com',
                'No_Handphone' => '085671092328'
            ],
            [
                'Nim' => '2078906775',
                'Nama' => 'Windha ayu',
                'Tanggal_Lahir' => '1999-11-13',
                'kelas_id' => '40',
                'Jurusan' => 'Teknologi Informasi',
                'Email' => 'wirdada1@gmail.com',
                'No_Handphone' => '082567809322'
            ],
            [
                'Nim' => '1941720040',
                'Nama' => 'Ahmad Danu',
                'Tanggal_Lahir' => '1999-01-15',
                'kelas_id' => '28',
                'Jurusan' => 'Teknologi Informasi',
                'Email' => 'ahmadanu01@gmail.com',
                'No_Handphone' => '085679032567'
            ],
            [
                'Nim' => '1941890765',
                'Nama' => 'Ifan Kurnia',
                'Tanggal_Lahir' => '2001-09-20',
                'kelas_id' => '24',
                'Jurusan' => 'Teknologi Informasi',
                'Email' => 'ifankur20@gmail.com',
                'No_Handphone' => '081334567800'
            ]
    ]);
    }
}