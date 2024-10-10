<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kategori;
use App\Models\Pangkat;
use App\Models\Satker;
use App\Models\Status;
use App\Models\WilayahKasus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
        ]);
       Kategori::create([
            'nama_kategori' => 'Kode Etik Profesi Polri
',
            
        ]);
       Pangkat::create([
            'nama_pangkat' => 'BRIPKA',
            
        ]);
       Satker::create([
            'nama_satker_satwil' => 'POLRES GRESIK',
            
        ]);
       Status::create([
            'nama_status' => 'Pengawasan',
            
        ]);
       WilayahKasus::create([
            'nama_wilayah' => 'POLRES GRESIK',
            
        ]);
        
    }
}
