<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kelas = [
                    ['nama_kelas' => 'TI 1A',],
                    ['nama_kelas' => 'TI 1B',],
                    ['nama_kelas' => 'TI 1C',],
                    ['nama_kelas' => 'TI 1D',],
                    ['nama_kelas' => 'TI 1E',],
                    ['nama_kelas' => 'TI 1F',],
                    ['nama_kelas' => 'TI 1G',],
                    ['nama_kelas' => 'TI 1H',],
                    ['nama_kelas' => 'TI 1I',],
                    ['nama_kelas' => 'TI 2A',],
                    ['nama_kelas' => 'TI 2B',],
                    ['nama_kelas' => 'TI 2C',],
                    ['nama_kelas' => 'TI 2D',],
                    ['nama_kelas' => 'TI 2E',],
                    ['nama_kelas' => 'TI 2F',],
                    ['nama_kelas' => 'TI 2G',],
                    ['nama_kelas' => 'TI 2H',],
                    ['nama_kelas' => 'TI 2I',],
                    ['nama_kelas' => 'TI 3A',],
                    ['nama_kelas' => 'TI 3B',],
                    ['nama_kelas' => 'TI 3C',],
                    ['nama_kelas' => 'TI 3D',],
                    ['nama_kelas' => 'TI 3E',],
                    ['nama_kelas' => 'TI 3F',],
                    ['nama_kelas' => 'TI 3G',],
                    ['nama_kelas' => 'TI 3H',],
                    ['nama_kelas' => 'TI 3I',],
                    ['nama_kelas' => 'TI 4A',],
                    ['nama_kelas' => 'TI 4B',],
                    ['nama_kelas' => 'TI 4C',],
                    ['nama_kelas' => 'TI 4D',],
                    ['nama_kelas' => 'TI 4E',],
                    ['nama_kelas' => 'TI 4F',],
                    ['nama_kelas' => 'TI 4G',],
                    ['nama_kelas' => 'TI 4H',],
                    ['nama_kelas' => 'TI 4I',]

           ];

        DB::table('kelas')->insert($kelas);
    }
}
