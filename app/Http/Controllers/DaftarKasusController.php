<?php

namespace App\Http\Controllers;

use App\Exports\KasusExport;
use App\Models\DaftarKasus;
use App\Models\Hukuman;
use App\Models\Kategori;
use App\Models\Pangkat;
use App\Models\Pelanggaran;
use App\Models\Satker;
use App\Models\Status;
use App\Models\WilayahKasus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class DaftarKasusController extends Controller
{
    function index() {
        
        // if (Auth::check() && !Auth::user()->can('lihat_kasus')) {
        //     // Menampilkan notifikasi error menggunakan Notify
        //     notify()->error('You do not have permission to access this page.');
    
        //     // Redirect kembali ke halaman sebelumnya
        //     return redirect()->back();
        // }
    if (Auth::user()->can('lihat_semua_kasus')) {
        $kasus = DaftarKasus::latest()->get();
    }else{
        $kasus = DaftarKasus::where('user_id',Auth::user()->id)->latest()->get();
    }
        return view('page.daftar_kasus_index',[
            'daftarKasus'=>$kasus,
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
            'pelanggaran' => Pelanggaran::all(),
            'hukuman' => Hukuman::all(),
        ]);
    }

    public function store(Request $request)
    {
        // try {
            $request->validate([
                'tanggal_lapor' => 'required|date',
                'nrp' => 'required|string|max:255|unique:kasus,nrp',
                'nama' => 'required|string|max:255',
                'jabatan' => 'required|string|max:255',
                'pangkat_saat_terkena_kasus' => 'required|string|max:255',
                'jabatan_saat_terkena_kasus' => 'required|string|max:255',
                'satker_saat_terkena_kasus' => 'required|string|max:255',
                'referensi' => 'required|string|max:255',
                'uraian' => 'required|string',
                'pasal' => 'required|string|max:255',
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
            
            // Handle file uploads and store paths in the validated array
            $validated = $request->all();
            $validated['user_id'] = Auth::user()->id;
            
            // Define an array of file fields to handle
            $fileFields = ['file_putusan_sidang', 'file_banding', 'file_rps'];
            
            foreach ($fileFields as $fileField) {
                if ($request->hasFile($fileField)) {
                    // Store the file and save the path in the validated array
                    $validated[$fileField] = $request->file($fileField)->store('rps_files', 'public');
                }
            }
            
            // Save the data to the database
            DaftarKasus::create($validated);
            
            
            notify()->success('Kasus Baru Berhasil Ditambahkan');
            return redirect()->route('daftarKasus');
        // } catch (\Throwable $th) {
        //     //throw $th;
        //     notify()->error('ERROR : '.$th->getMessage());
        //     return redirect()->back();
        // }
    }

    public function edit($id)
    {
        $kasus = DaftarKasus::findOrFail($id); // Get the existing Kasus record
        $kategori = Kategori::all(); // Get all Kategori records
        $pangkat = Pangkat::all(); // Get all Pangkat records
        $satker_satwil = Satker::all(); // Get all Satker records
        $wilayah = WilayahKasus::all(); // Get all WilayahKasus records
        $status = Status::all(); // Get all Status records
        $pelanggaran = Pelanggaran::all();
        $hukuman = Hukuman::all();

        // Return the edit view with the existing Kasus and related data
        return view('page.edit_kasus', compact('pelanggaran','hukuman','kasus', 'kategori', 'pangkat', 'satker_satwil', 'wilayah', 'status'));
    }
    /**
     * Perbarui data kasus yang ada.
     */
    // public function update(Request $request, $id)
    // {
    //     // Validate the request data
    //     $request->validate([
    //         'kategori_id' => 'required|exists:kategori,id',
    //         'tanggal_lapor' => 'required|date',
    //         'nrp' => 'required|string',
    //         'uraian' => 'required|string',
    //         'nama' => 'required|string|max:255',
    //         'pangkat_id' => 'required|exists:pangkat,id',
    //         'jabatan' => 'required|string|max:255',
    //         'satker_satwil_id' => 'required|exists:satker_satwil,id',
    //         'pangkat_saat_terkena_kasus' => 'required|string|max:255',
    //         'jabatan_saat_terkena_kasus' => 'required|string|max:255',
    //         'wilayah_kasus_id' => 'required|exists:wilayah_kasus,id',
    //         'pasal' => 'nullable|string|max:255',
    //         'tanggal_putusan' => 'nullable|date',
    //         'nomor_putusan' => 'nullable|string',
    //         'tanggal_putusan_keberatan' => 'nullable|date',
    //         'nomor_putusan_keberatan' => 'nullable|string',
    //         'tanggal_dimulai_hukuman' => 'nullable|date',
    //         'tanggal_rps' => 'nullable|date',
    //         'no_rps' => 'nullable|string',
    //         'status_id' => 'required|exists:status,id',
    //         'hukuman_id' => 'nullable|integer|exists:hukuman,id',
    //         'pelanggaran_id' => 'required|integer|exists:pelanggaran,id',

    //     ]);
    //     if ($request->hasFile('file_putusan_sidang')) {
    //         // Store the file and get the path
    //         $filePath = $request->file('file_putusan_sidang')->store('rps_files', 'public');
    //         $validated['file_putusan_sidang'] = $filePath; // Save the file path in the database
    //     }

    //     if ($request->hasFile('file_banding')) {
    //         // Store the file and get the path
    //         $filePath = $request->file('file_banding')->store('rps_files', 'public');
    //         $validated['file_banding'] = $filePath; // Save the file path in the database
    //     }

    //     if ($request->hasFile('file_rps')) {
    //         // Store the file and get the path
    //         $filePath = $request->file('file_rps')->store('rps_files', 'public');
    //         $validated['file_rps'] = $filePath; // Save the file path in the database
    //     }
    //     $validated['user_id'] = Auth::user()->id;
    //     // Find the existing Kasus record
    //     $kasus = DaftarKasus::findOrFail($id);
        
    //     // Update the Kasus with the request data
    //     $kasus->update($request->all());
    //     notify()->success('Kasus Berhasil Diubah');
    //     return redirect()->route('daftarKasus');
    // }
    public function update(Request $request, $id)
    {
    // Temukan record Kasus yang ada
    $kasus = DaftarKasus::findOrFail($id);
    // Validasi data request
    $validated = $request->validate([
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
        'pasal' => 'nullable|string|max:255',
        'tanggal_putusan' => 'nullable|date',
        'nomor_putusan' => 'nullable|string',
        'tanggal_putusan_keberatan' => 'nullable|date',
        'nomor_putusan_keberatan' => 'nullable|string',
        'tanggal_dimulai_hukuman' => 'nullable|date',
        'tanggal_rps' => 'nullable|date',
        'no_rps' => 'nullable|string',
        'status_id' => 'required|exists:status,id',
        'hukuman_id' => 'nullable|integer|exists:hukuman,id',
        'pelanggaran_id' => 'required|integer|exists:pelanggaran,id',
    ]);

    // Handle file uploads
    $files = ['file_putusan_sidang', 'file_banding', 'file_rps'];

    foreach ($files as $file) {
        if ($request->hasFile($file)) {
            // Cek apakah file lama ada, jika ada hapus file lama terlebih dahulu
            if ($kasus->$file) {
                Storage::disk('public')->delete($kasus->$file);
            }

            // Simpan file baru
            $filePath = $request->file($file)->store('rps_files', 'public');
            $validated[$file] = $filePath; // Update file path pada data yang divalidasi
        } else {
            // Jika tidak ada file baru, tetap pertahankan file lama
            if ($kasus->$file) {
                $validated[$file] = $kasus->$file; // Gunakan file lama
            }
        }
    }

    // Tambahkan user_id
    $validated['user_id'] = Auth::user()->id;

    

    // Perbarui Kasus dengan data yang sudah divalidasi
    $kasus->update($validated);

    // Notifikasi berhasil
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
       // Menggunakan 'now()' dengan zona waktu WIT (Asia/Jayapura)
        $timestamp = now('Asia/Jayapura')->format('Y_m_d_H_i ');  // Format: Tahun_Bulan_Tanggal_Jam_Menit_Detik
        
        // Menambahkan timestamp ke nama file Excel
        return Excel::download(new KasusExport, 'daftar_kasus_' . $timestamp . '.xlsx');
    }
}
