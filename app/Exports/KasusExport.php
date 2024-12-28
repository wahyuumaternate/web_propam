<?php

namespace App\Exports;

use App\Models\DaftarKasus;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KasusExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if (Auth::user()->can('lihat_semua_kasus')) {
            // Select all fields to be exported, including related data
            return DaftarKasus::with(['kategori', 'pangkat', 'satkerSatwil', 'wilayahKasus', 'status', 'hukuman', 'pelanggaran'])
                ->get()
                ->map(function ($kasus, $index) {
                    return [
                        'no' => $index + 1, // Menambahkan nomor urut mulai dari 1
                        'tanggal_lapor' => $kasus->tanggal_lapor ?? '-',
                        'nrp' => (string) "'" . ($kasus->nrp ?? '-'),
                        'nama' => $kasus->nama ?? '-',
                        'jabatan' => $kasus->jabatan ?? '-',
                        'pangkat_saat_terkena_kasus' => $kasus->pangkat_saat_terkena_kasus ?? '-',
                        'jabatan_saat_terkena_kasus' => $kasus->jabatan_saat_terkena_kasus ?? '-',
                        'referensi' => $kasus->referensi ?? '-',
                        'bentuk_pelanggaran' => $kasus->pelanggaran->nama_pelanggaran ?? '-',
                        'pasal' => $kasus->pasal ?? '-',
                        'hukuman' => $kasus->hukuman->nama_hukuman ?? '-',
                        'tanggal_putusan' => $kasus->tanggal_putusan ?? '-',
                        'nomor_putusan' => $kasus->nomor_putusan ?? '-',
                        'tanggal_putusan_keberatan' => $kasus->tanggal_putusan_keberatan ?? '-',
                        'nomor_putusan_keberatan' => $kasus->nomor_putusan_keberatan ?? '-',
                        'tanggal_dimulai_hukuman' => $kasus->tanggal_dimulai_hukuman ?? '-',
                        'tanggal_rps' => $kasus->tanggal_rps ?? '-',
                        'no_rps' => $kasus->no_rps ?? '-',
                        'uraian' => $kasus->uraian ?? '-',
                        'kategori' => $kasus->kategori->nama_kategori ?? '-',
                        'pangkat' => $kasus->pangkat->nama_pangkat ?? '-',
                        'satker_satwil' => $kasus->satkerSatwil->nama_satker_satwil ?? '-',
                        'status' => $kasus->status->nama_status ?? '-',
                        'created_at' => $kasus->created_at ?? '-',
                    ];
                });
        } else {
            // Select all fields to be exported, including related data
            return DaftarKasus::with(['kategori', 'pangkat', 'satkerSatwil', 'wilayahKasus', 'status', 'hukuman', 'pelanggaran'])
                ->where('user_id', Auth::user()->id)
                ->get()
                ->map(function ($kasus, $index) {
                    return [
                        'no' => $index + 1, // Menambahkan nomor urut mulai dari 1
                        'tanggal_lapor' => $kasus->tanggal_lapor ?? '-',
                        'nrp' => (string) "'" . ($kasus->nrp ?? '-'),
                        'nama' => $kasus->nama ?? '-',
                        'jabatan' => $kasus->jabatan ?? '-',
                        'pangkat_saat_terkena_kasus' => $kasus->pangkat_saat_terkena_kasus ?? '-',
                        'jabatan_saat_terkena_kasus' => $kasus->jabatan_saat_terkena_kasus ?? '-',
                        'referensi' => $kasus->referensi ?? '-',
                        'bentuk_pelanggaran' => $kasus->pelanggaran->nama_pelanggaran ?? '-',
                        'pasal' => $kasus->pasal ?? '-',
                        'hukuman' => $kasus->hukuman->nama_hukuman ?? '-',
                        'tanggal_putusan' => $kasus->tanggal_putusan ?? '-',
                        'nomor_putusan' => $kasus->nomor_putusan ?? '-',
                        'tanggal_putusan_keberatan' => $kasus->tanggal_putusan_keberatan ?? '-',
                        'nomor_putusan_keberatan' => $kasus->nomor_putusan_keberatan ?? '-',
                        'tanggal_dimulai_hukuman' => $kasus->tanggal_dimulai_hukuman ?? '-',
                        'tanggal_rps' => $kasus->tanggal_rps ?? '-',
                        'no_rps' => $kasus->no_rps ?? '-',
                        'uraian' => $kasus->uraian ?? '-',
                        'kategori' => $kasus->kategori->nama_kategori ?? '-',
                        'pangkat' => $kasus->pangkat->nama_pangkat ?? '-',
                        'satker_satwil' => $kasus->satkerSatwil->nama_satker_satwil ?? '-',
                        'status' => $kasus->status->nama_status ?? '-',
                        'created_at' => $kasus->created_at ?? '-',
                    ];
                });
        }
    }

    /**
     * Define the headings for the Excel file
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'No', // Menambahkan kolom No
            'Tanggal Lapor',
            'NRP',
            'Nama',
            'Jabatan',
            'Pangkat Saat Terkena Kasus',
            'Jabatan Saat Terkena Kasus',
            'Referensi',
            'Bentuk Pelanggaran',
            'Pasal',
            'Hukuman',
            'Tanggal Putusan',
            'Nomor Putusan',
            'Tanggal Putusan Keberatan',
            'Nomor Putusan Keberatan',
            'Tanggal Dimulai Hukuman',
            'Tanggal RPS',
            'No RPS',
            'Uraian',
            'Kategori',
            'Pangkat',
            'Satker/Satwil',
            'Status',
            'Tanggal Dibuat',
        ];
    }
}