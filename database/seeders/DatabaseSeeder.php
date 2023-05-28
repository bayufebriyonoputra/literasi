<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Siswa::create([
            'tahun_masuk' => '2022',
            'nomor_induk' => '123',
            'password' => bcrypt('123'),
            'nama' => 'agus',
            'alamat' => 'Mojokerto',
            'jenis_kelamin' => 'L',
            'nama_wali' => 'Udin',
            'hp_siswa' => '0230283082',
            'hp_wali' => '038203223',
            'tes_diagnostik' => 'OK',
            'tahun_pelajaran' => '2022/2023'
        ]);


        \App\Models\Guru::create([
            'nip' => '123',
            'password' => bcrypt('123'),
            'nama' => 'Ahmad',
            'alamat' => 'Sooko',
            'jenis_kelamin' => 'L',
            'admin' => true
        ]);
    }
}
