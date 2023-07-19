<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::create([
            'username' => 'admin1',
            'nama_petugas' => 'Jamaludin',
            'password' => 'admin123',
            'level' => 'admin'
        ]);

        \App\Models\User::create([
            'username' => 'petugas1',
            'nama_petugas' => 'Asep',
            'password' => 'petugas123',
            'level' => 'petugas'
        ]);

        \App\Models\Spp::create([
            'nominal' => '200000',
            'tahun' => '2023'
        ]);

        \App\Models\Kelas::create([
            'nama_kelas' => 'XI PPLG 1',
            'kompetensi_keahlian' => 'Pemodelan Perangkat Lunak dan Gim'
        ]);

        \App\Models\Kelas::create([
            'nama_kelas' => 'XI PPLG 2',
            'kompetensi_keahlian' => 'Pemodelan Perangkat Lunak dan Gim'
        ]);

        \App\Models\Kelas::create([
            'nama_kelas' => 'XI PPLG 3',
            'kompetensi_keahlian' => 'Pemodelan Perangkat Lunak dan Gim'
        ]);

        \App\Models\Kelas::create([
            'nama_kelas' => 'XI PPLG 4',
            'kompetensi_keahlian' => 'Pemodelan Perangkat Lunak dan Gim'
        ]);

        \App\Models\Siswa::create([
            'nisn' => '5639875425',
            'nis' => '00126553',
            'nama' => 'Tia Niandari',
            'id_kelas' => 4,
            'alamat' => 'Dusun Manis, Jatimulya.',
            'no_telp' => '0836891762721',
            'id_spp' => 1,
            'level' => 'siswa'
        ]);

        \App\Models\Siswa::create([
            'nisn' => '5639875423',
            'nis' => '00126521',
            'nama' => 'Aji Nur Aji',
            'id_kelas' => 4,
            'alamat' => 'Dusun Cimulya, Cihideunghilir.',
            'no_telp' => '0836835907364',
            'id_spp' => 1,
            'level' => 'siswa'
        ]);
    }
}
