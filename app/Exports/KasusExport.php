<?php

namespace App\Exports;

use App\Models\DaftarKasus;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KasusExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Select all fields to be exported, including related data
        return DaftarKasus::with(['kategori', 'pangkat', 'satkerSatwil', 'wilayahKasus', 'status'])
            ->get()
            ->map(function ($kasus) {
                return [
                    'tanggal_lapor' => $kasus->tanggal_lapor,
                    'nrp' => $kasus->nrp,
                    'nama' => $kasus->nama,
                    'jabatan' => $kasus->jabatan,
                    'pangkat_saat_terkena_kasus' => $kasus->pangkat_saat_terkena_kasus,
                    'jabatan_saat_terkena_kasus' => $kasus->jabatan_saat_terkena_kasus,
                    'referensi' => $kasus->referensi,
                    'bentuk_pelanggaran' => $kasus->bentuk_pelanggaran,
                    'pasal' => $kasus->pasal,
                    'hukuman' => $kasus->hukuman,
                    'tanggal_putusan' => $kasus->tanggal_putusan,
                    'nomor_putusan' => $kasus->nomor_putusan,
                    'tanggal_putusan_keberatan' => $kasus->tanggal_putusan_keberatan,
                    'nomor_putusan_keberatan' => $kasus->nomor_putusan_keberatan,
                    'tanggal_dimulai_hukuman' => $kasus->tanggal_dimulai_hukuman,
                    'tanggal_rps' => $kasus->tanggal_rps,
                    'no_rps' => $kasus->no_rps,
                    // 'file_putusan_sidang' => $kasus->file_putusan_sidang,
                    // 'file_banding' => $kasus->file_banding,
                    // 'file_rps' => $kasus->file_rps,
                    'uraian' => $kasus->uraian,
                    // 'updated_at' => $kasus->updated_at,
                    // Include related data
                    'kategori' => $kasus->kategori->nama_kategori ?? 'N/A',
                    'pangkat' => $kasus->pangkat->nama_pangkat ?? 'N/A',
                    'satker_satwil' => $kasus->satkerSatwil->nama_satker_satwil ?? 'N/A',
                    'wilayah_kasus' => $kasus->wilayahKasus->nama_wilayah ?? 'N/A',
                    'status' => $kasus->status->nama_status ?? 'N/A',
                    'created_at' => $kasus->created_at,
                ];
            });
    }

    /**
     * Define the headings for the Excel file
     *
     * @return array
     */
    public function headings(): array
    {
        return [
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
            // 'File Putusan Sidang',
            // 'File Banding',
            // 'File RPS',
            'Uraian',
            // 'Updated At',
            'Kategori',
            'Pangkat',
            'Satker/Satwil',
            'Wilayah Kasus',
            'Status',
            'Created At',
        ];
    }
}