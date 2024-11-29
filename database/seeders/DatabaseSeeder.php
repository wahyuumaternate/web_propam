<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DaftarKasus;
use App\Models\Hukuman;
use App\Models\Kategori;
use App\Models\Pangkat;
use App\Models\Pelanggaran;
use App\Models\Satker;
use App\Models\Status;
use App\Models\TamplateSKHP;
use App\Models\WilayahKasus;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

        \App\Models\User::create([
            'name' => 'staff',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('staff123'),
        ]);

        \App\Models\User::create([
            'name' => 'staff2',
            'email' => 'staff2@gmail.com',
            'password' => Hash::make('staff123'),
        ]);
        \App\Models\User::create([
            'name' => 'kabid',
            'email' => 'kabid@gmail.com',
            'password' => Hash::make('kabid123'),
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
       Status::create([
            'nama_status' => 'Selesai',
            
        ]);
       WilayahKasus::create([
            'nama_wilayah' => 'POLRES GRESIK',
            
        ]);
       Hukuman::create([
            'nama_hukuman' => 'HUKUMAN 1',
            
        ]);
       Pelanggaran::create([
            'nama_pelanggaran' => 'Pelanggaran 1',
            
        ]);

        
        DB::table('kasus')->insert([
            [
                'kategori_id' => 1, // Pastikan ID ini ada di tabel kategori
                'tanggal_lapor' => Carbon::now()->subDays(30)->format('Y-m-d'),
                'nrp' => '123456789',
                'nama' => 'John Doe',
                'pangkat_id' => 1, // Pastikan ID ini ada di tabel pangkat
                'jabatan' => 'Anggota',
                'satker_satwil_id' => 1, // Pastikan ID ini ada di tabel satker_satwil
                'pangkat_saat_terkena_kasus' => 'BRIPKA',
                'jabatan_saat_terkena_kasus' => 'Polisi',
                'satker_saat_terkena_kasus' => 'Ipda',
                'wilayah_kasus_id' => 1, // Pastikan ID ini ada di tabel wilayah_kasus
                'pasal' => 'Pasal 123',
                'tanggal_putusan' => Carbon::now()->subDays(15)->format('Y-m-d'),
                'nomor_putusan' => '123/XYZ/2023',
                'tanggal_putusan_keberatan' => Carbon::now()->subDays(10)->format('Y-m-d'),
                'nomor_putusan_keberatan' => '456/XYZ/2023',
                'tanggal_dimulai_hukuman' => Carbon::now()->subDays(5)->format('Y-m-d'),
                'tanggal_rps' => Carbon::now()->format('Y-m-d'),
                'no_rps' => 'RPS-123456',
                'status_id' => 1, // Pastikan ID ini ada di tabel status
                'hukuman_id' => 1, // Pastikan ID ini ada di tabel hukuman atau nullable jika tidak diisi
                'pelanggaran_id' => 1, // Pastikan ID ini ada di tabel pelanggaran
                'uraian' => 'Uraian kasus John Doe yang dilaporkan dan sedang diproses.',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kategori_id' => 1, // Pastikan ID ini ada di tabel kategori
                'tanggal_lapor' => Carbon::now()->subDays(60)->format('Y-m-d'),
                'nrp' => '987654321',
                'nama' => 'Jane Smith',
                'pangkat_id' => 1, // Pastikan ID ini ada di tabel pangkat
                'jabatan' => 'Perwira',
                'satker_satwil_id' => 1, // Pastikan ID ini ada di tabel satker_satwil
                'pangkat_saat_terkena_kasus' => 'BRIPKA',
                'satker_saat_terkena_kasus' => 'BRIPKA',
                'jabatan_saat_terkena_kasus' => 'Komandan',
                'wilayah_kasus_id' => 1, // Pastikan ID ini ada di tabel wilayah_kasus
                'pasal' => 'Pasal 456',
                'tanggal_putusan' => Carbon::now()->subDays(30)->format('Y-m-d'),
                'nomor_putusan' => '789/XYZ/2023',
                'tanggal_putusan_keberatan' => Carbon::now()->subDays(20)->format('Y-m-d'),
                'nomor_putusan_keberatan' => '101/XYZ/2023',
                'tanggal_dimulai_hukuman' => Carbon::now()->subDays(15)->format('Y-m-d'),
                'tanggal_rps' => Carbon::now()->subDays(10)->format('Y-m-d'),
                'no_rps' => 'RPS-654321',
                'status_id' => 1, // Pastikan ID ini ada di tabel status
                'hukuman_id' => 1, // Pastikan ID ini ada di tabel hukuman atau nullable jika tidak diisi
                'pelanggaran_id' => 1, // Pastikan ID ini ada di tabel pelanggaran
                'uraian' => 'Uraian kasus Jane Smith yang dilaporkan dan sedang diproses.',
                'user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        DB::table('skhp')->insert([
            [
                'nama' => 'John Doe',
                'tanggal_lahir' => Carbon::create('1990', '01', '01')->format('Y-m-d'), // Tanggal Lahir
                'jenis_kelamin' => 'Laki-laki', // Jenis Kelamin
                'agama' => 'Islam', // Agama
                'nrp_nip' => '123456789', // Pangkat / NRP / NIP
                'jabatan' => 'Anggota', // Jabatan
                'kesatuan_instansi' => 'POLRES GRESIK', // Kesatuan / Instansi
                'alamat_kantor' => 'Jl. Raya Gresik No. 1', // Alamat Kantor
                'id_pangkat' => 1, // Alamat Kantor
                'peruntukan' => 'MENGIKUTI PENGUSULAN KENAIKAN PANGKAT
                    TMT PERIODE 01 JANUARI 2025', // Alamat Kantor
                'tempat_lahir' => 'Ternate', // Alamat Kantor
                'user_id' => 1,
            ],
            [
                'nama' => 'Jane Smith',
                'tanggal_lahir' => Carbon::create('1985', '05', '15')->format('Y-m-d'),
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Kristen',
                'nrp_nip' => '987654321',
                'jabatan' => 'Kepala',
                'kesatuan_instansi' => 'POLSEK GRESIK',
                'alamat_kantor' => 'Jl. Raya Gresik No. 2',
                'id_pangkat' => 1,
                'peruntukan' => 'MENGIKUTI PENGUSULAN KENAIKAN PANGKAT
                    TMT PERIODE 01 JANUARI 2025',
                'tempat_lahir' => 'Ternate',
                'user_id' => 1,
            ],
            [
                'nama' => 'Michael Johnson',
                'tanggal_lahir' => Carbon::create('1980', '11', '25')->format('Y-m-d'),
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Protestan',
                'nrp_nip' => 'AKP 1122334455',
                'jabatan' => 'Perwira',
                'kesatuan_instansi' => 'POLRES GRESIK',
                'alamat_kantor' => 'Jl. Raya Gresik No. 3',
                'id_pangkat' => 1,
                'peruntukan' => 'MENGIKUTI PENGUSULAN KENAIKAN PANGKAT
                    TMT PERIODE 01 JANUARI 2025',
                'tempat_lahir' => 'Ternate',
                'user_id' => 2,
            ]
        ]);

        TamplateSKHP::create([
            'di_keluar_di' => 'Surabaya',
            'kabid_nama' => 'Michael Brown',
            'kabid_pangkat' => 'Brigadier General',
            'kabid_nrp' => '9988776655',
            'kasubid_nama' => 'Sarah Lee',
            'kasubid_pangkat' => 'Major',
            'kasubid_nrp' => '5544332211',
        ]);

        $this->call([
            RolePermissionSeeder::class,
        ]);
        
    }
}
