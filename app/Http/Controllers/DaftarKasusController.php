<?php

namespace App\Http\Controllers;

use App\Models\DaftarKasus;
use App\Models\Kategori;
use App\Models\Pangkat;
use App\Models\Satker;
use App\Models\Status;
use App\Models\WilayahKasus;
use Illuminate\Http\Request;

class DaftarKasusController extends Controller
{
    function index() {
        return view('page.daftar_kasus_index',[
            'daftarKasus'=>DaftarKasus::latest()->get()
        ]);
    }
    function create() {
        return view('page.tambah_kasus',[
            'kategori'=>Kategori::all(),
            'pangkat'=>Pangkat::all(),
            'satker_satwil'=>Satker::all(),
            'wilayah'=>WilayahKasus::all(),
            'status'=>Status::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_lapor' => 'required|date',
            'nrp' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'pangkat_saat_terkena_kasus' => 'required|string|max:255',
            'jabatan_saat_terkena_kasus' => 'required|string|max:255',
            'referensi' => 'required|string|max:255',
            'uraian' => 'required|string|max:255',
            'bentuk_pelanggaran' => 'required|string|max:255',
            'pasal' => 'required|string|max:255',
            'hukuman' => 'required|string|max:255',
            'tanggal_putusan' => 'required|date',
            'nomor_putusan' => 'required|string|max:255',
            'tanggal_putusan_keberatan' => 'required|date',
            'nomor_putusan_keberatan' => 'required|string|max:255',
            'tanggal_dimulai_hukuman' => 'required|date',
            'tanggal_rps' => 'required|date',
            'no_rps' => 'required|string|max:255',
            'kategori_id' => 'required|integer|exists:kategori,id',
            'pangkat_id' => 'required|integer|exists:pangkat,id',
            'satker_satwil_id' => 'required|integer|exists:satker_satwil,id',
            'wilayah_kasus_id' => 'required|integer|exists:wilayah_kasus,id',
            'status_id' => 'required|integer|exists:status,id',
            'file_putusan_sidang' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file_banding' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file_rps' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('file_putusan_sidang')) {
            // Store the file and get the path
            $filePath = $request->file('file_putusan_sidang')->store('rps_files', 'public');
            $validated['file_putusan_sidang'] = $filePath; // Save the file path in the database
        }

        if ($request->hasFile('file_banding')) {
            // Store the file and get the path
            $filePath = $request->file('file_banding')->store('rps_files', 'public');
            $validated['file_banding'] = $filePath; // Save the file path in the database
        }

        if ($request->hasFile('file_rps')) {
            // Store the file and get the path
            $filePath = $request->file('file_rps')->store('rps_files', 'public');
            $validated['file_rps'] = $filePath; // Save the file path in the database
        }
        // Simpan data ke database
        DaftarKasus::create($request->all());
        
        notify()->success('Kasus Baru Berhasil Ditambahkan');
        return redirect()->route('daftarKasus');
    }

    /**
     * Perbarui data kasus yang ada.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_lapor' => 'sometimes|date',
            'nrp' => 'sometimes|string|unique:kasus,nrp,' . $id,
            'nama' => 'sometimes|string',
            'jabatan' => 'sometimes|string',
            'pangkat_saat_terkena_kasus' => 'sometimes|string',
            'jabatan_saat_terkena_kasus' => 'sometimes|string',
            'bentuk_pelanggaran' => 'sometimes|string',
            'kategori_id' => 'sometimes|integer|exists:kategori,id',
            'pangkat_id' => 'sometimes|integer|exists:pangkat,id',
            'satker_satwil_id' => 'sometimes|integer|exists:satker_satwil,id',
            'wilayah_kasus_id' => 'sometimes|integer|exists:wilayah_kasus,id',
            'status_id' => 'sometimes|integer|exists:status,id',
        ]);

        // Cari data kasus berdasarkan ID
        $kasus = DaftarKasus::findOrFail($id);

        // Perbarui data
        $kasus->update($request->all());

        return redirect()->route('daftarKasus')->with('success','Berhasil');
    }
}
