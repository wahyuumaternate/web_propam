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
        return view('page.daftar_kasus_index');
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
            'nrp' => 'required|string|unique:kasus,nrp',
            'nama' => 'required|string',
            'jabatan' => 'required|string',
            'pangkat_saat_terkena_kasus' => 'required|string',
            'jabatan_saat_terkena_kasus' => 'required|string',
            'bentuk_pelanggaran' => 'required|string',
            'kategori_id' => 'required|integer|exists:kategori,id',
            'pangkat_id' => 'required|integer|exists:pangkat,id',
            'satker_satwil_id' => 'required|integer|exists:satker_satwil,id',
            'wilayah_kasus_id' => 'required|integer|exists:wilayah_kasus,id',
            'status_id' => 'required|integer|exists:status,id',
        ]);

        // Simpan data ke database
        DaftarKasus::create($request->all());

        return redirect()->route('daftarKasus')->with('success','Berhasil');
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
