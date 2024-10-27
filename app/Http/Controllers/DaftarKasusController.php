<?php

namespace App\Http\Controllers;

use App\Exports\KasusExport;
use App\Models\DaftarKasus;
use App\Models\Kategori;
use App\Models\Pangkat;
use App\Models\Satker;
use App\Models\Status;
use App\Models\WilayahKasus;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DaftarKasusController extends Controller
{
    function index() {
        return view('page.daftar_kasus_index',[
            'daftarKasus'=>DaftarKasus::latest()->get(),
            'statuses'=>Status::all(),
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
            'uraian' => 'required|string',
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

    public function edit($id)
    {
        $kasus = DaftarKasus::findOrFail($id); // Get the existing Kasus record
        $kategori = Kategori::all(); // Get all Kategori records
        $pangkat = Pangkat::all(); // Get all Pangkat records
        $satker_satwil = Satker::all(); // Get all Satker records
        $wilayah = WilayahKasus::all(); // Get all WilayahKasus records
        $status = Status::all(); // Get all Status records

        // Return the edit view with the existing Kasus and related data
        return view('page.edit_kasus', compact('kasus', 'kategori', 'pangkat', 'satker_satwil', 'wilayah', 'status'));
    }
    /**
     * Perbarui data kasus yang ada.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'tanggal_lapor' => 'required|date',
            'nrp' => 'required|string',
            'uraian' => 'required|string',
            'nama' => 'required|string|max:255',
            'pangkat_id' => 'required|exists:pangkat,id',
            'jabatan' => 'required|string|max:255',
            'satker_satwil_id' => 'required|exists:satker_satwil,id',
            'pangkat_saat_terkena_kasus' => 'required|string|max:255',
            'jabatan_saat_terkena_kasus' => 'required|string|max:255',
            'wilayah_kasus_id' => 'required|exists:wilayah_kasus,id',
            'bentuk_pelanggaran' => 'required|string|max:255',
            'pasal' => 'nullable|string|max:255',
            'hukuman' => 'nullable|string|max:255',
            'tanggal_putusan' => 'nullable|date',
            'nomor_putusan' => 'nullable|string',
            'tanggal_putusan_keberatan' => 'nullable|date',
            'nomor_putusan_keberatan' => 'nullable|string',
            'tanggal_dimulai_hukuman' => 'nullable|date',
            'tanggal_rps' => 'nullable|date',
            'no_rps' => 'nullable|string',
            'status_id' => 'required|exists:status,id',
        ]);

        // Find the existing Kasus record
        $kasus = DaftarKasus::findOrFail($id);

        // Update the Kasus with the request data
        $kasus->update($request->all());
        notify()->success('Kasus Berhasil Diubah');
        return redirect()->route('daftarKasus');
    }

    public function destroy($id)
    {
        // Mencari data kasus berdasarkan ID
        $kasus = DaftarKasus::find($id);

        // Jika data tidak ditemukan, redirect kembali dengan notifikasi error
        if (!$kasus) {
            notify()->error('Data tidak ditemukan');
            return redirect()->back();
        }

        // Menghapus data kasus
        $kasus->delete();

        // Redirect kembali dengan notifikasi sukses
        notify()->success('Data berhasil dihapus');
        return redirect()->back();
    }

    public function updateStatus(Request $request, $id)
    {
        $kasus = DaftarKasus::find($id);
        $kasus->status_id = $request->status_id;
        $kasus->save();

        // notify()->success('Status Berhasil Diganti');
        return response()->json(['success' => true]);
    }

    public function export()
    {
        return Excel::download(new KasusExport, 'daftar_kasus.xlsx');
    }
}
