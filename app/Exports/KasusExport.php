<?php

namespace App\Exports;

use App\Models\DaftarKasus;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KasusExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $query = DaftarKasus::with(['kategori', 'pangkat', 'satkerSatwil', 'wilayahKasus', 'status', 'kasusHukuman.hukuman', 'pelanggaran']);
    
        if (!Auth::user()->can('lihat_semua_kasus')) {
            $query->where('user_id', Auth::user()->id);
        }
    
        return $query->get()->map(function ($kasus, $index) {
            // Get hukuman names through the nested relationship
            $hukumanNames = $kasus->kasusHukuman->map(function($kasusHukuman) {
                return $kasusHukuman->hukuman->nama_hukuman ?? '';
            })->filter()->implode(', ');
            
            return [
                'no' => $index + 1,
                'tanggal_lapor' => $kasus->tanggal_lapor ?? '-',
                'nrp' => "'" . ($kasus->nrp ?? '-'),
                'nama' => $kasus->nama ?? '-',
                'jabatan' => $kasus->jabatan ?? '-',
                'pangkat_saat_terkena_kasus' => $kasus->pangkat_saat_terkena_kasus ?? '-',
                'jabatan_saat_terkena_kasus' => $kasus->jabatan_saat_terkena_kasus ?? '-',
                'referensi' => $kasus->referensi ?? '-',
                'bentuk_pelanggaran' => $kasus->pelanggaran->nama_pelanggaran ?? '-',
                'pasal' => $kasus->pasal ?? '-',
                'hukuman' => $hukumanNames ?: '-',
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

    public function headings(): array
    {
        return [
            'No',
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