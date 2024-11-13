<?php

namespace Database\Factories;

use App\Models\DaftarKasus;
use App\Models\Kategori;
use App\Models\Pangkat;
use App\Models\Satker;
use App\Models\Status;
use App\Models\WilayahKasus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DaftarKasusFactory extends Factory
{
    protected $model = DaftarKasus::class;

    public function definition()
    {
        return [
            'tanggal_lapor' => $this->faker->date(),
            'nrp' => $this->faker->unique()->numerify('######'), // Generates a 6-digit number
            'nama' => $this->faker->name(),
            'jabatan' => $this->faker->jobTitle(),
            'pangkat_saat_terkena_kasus' => $this->faker->word(),
            'jabatan_saat_terkena_kasus' => $this->faker->jobTitle(),
            'referensi' => $this->faker->sentence(),
            'uraian' => $this->faker->sentence(),
            'bentuk_pelanggaran' => $this->faker->sentence(),
            'pasal' => $this->faker->sentence(),
            'hukuman' => $this->faker->sentence(),
            'tanggal_putusan' => $this->faker->date(),
            'nomor_putusan' => $this->faker->unique()->numerify('###'), // Nullable
            'tanggal_putusan_keberatan' => $this->faker->date(),
            'nomor_putusan_keberatan' => $this->faker->unique()->numerify('KEBERATAN-###'),
            'tanggal_dimulai_hukuman' => $this->faker->date(),
            'tanggal_rps' => $this->faker->date(),
            'no_rps' => $this->faker->unique()->numerify('RPS-###'),
            'file_putusan_sidang' => $this->faker->word() . '.pdf',
            'file_banding' => $this->faker->word() . '.pdf',
            'file_rps' => $this->faker->word() . '.pdf',
            'kategori_id' => 1,
            'pangkat_id' => 1,
            'satker_satwil_id' => 1,
            'wilayah_kasus_id' => 1,
            'status_id' => 1,
            // 'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
    }
}
