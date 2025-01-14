<?php

namespace App\Http\Controllers;

use App\Exports\KasusExport;
use App\Models\DaftarKasus;
use App\Models\Hukuman;
use App\Models\KasusHukuman;
use App\Models\Kategori;
use App\Models\Pangkat;
use App\Models\Pelanggaran;
use App\Models\Satker;
use App\Models\Status;
use App\Models\WilayahKasus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
                'tanggal_putusan' => 'nullable|date',
                'nomor_putusan' => 'nullable|string|max:255',
                'tanggal_putusan_keberatan' => 'nullable|date',
                'nomor_putusan_keberatan' => 'nullable|string|max:255',
                'tanggal_dimulai_hukuman' => 'nullable|date',
                'tanggal_rps' => 'nullable|date',
                'no_rps' => 'nullable|string|max:255',
                'kategori_id' => 'required|integer|exists:kategori,id',
                'pangkat_id' => 'required|integer|exists:pangkat,id',
                'satker_satwil_id' => 'required|integer|exists:satker_satwil,id',
                'wilayah_kasus_id' => 'required|integer|exists:wilayah_kasus,id',
                'status_id' => 'required|integer|exists:status,id',
                'hukuman_id' => 'nullable|array',
                'hukuman_id.*' => 'exists:hukuman,id',
                'pelanggaran_id' => 'required|integer|exists:pelanggaran,id',
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
            $daftarKasus =  DaftarKasus::create($validated);
              // Create the DaftarKasus record
        // $daftarKasus = DaftarKasus::create($validated);
            if ($request->has('hukuman_id')) {
                foreach ($request->hukuman_id as $hukuman_id) {
                    KasusHukuman::create([
                        'daftar_kasus_id' => $daftarKasus->id,
                        'hukuman_id' => $hukuman_id,
                    ]);
                }
            }
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
        $kasusHukuman = DB::table('kasus_hukuman')
        ->where('daftar_kasus_id', $id)
        ->pluck('hukuman_id')
        ->toArray();

        // Return the edit view with the existing Kasus and related data
        return view('page.edit_kasus', compact('kasusHukuman','pelanggaran','hukuman','kasus', 'kategori', 'pangkat', 'satker_satwil', 'wilayah', 'status'));
    }
  
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
        'hukuman_id' => 'nullable|array',
        'hukuman_id.*' => 'exists:hukuman,id',
        'pelanggaran_id' => 'required|integer|exists:pelanggaran,id',
        'file_putusan_sidang' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        'file_banding' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        'file_rps' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
    ]);

    // Handle file uploads
    $files = ['file_putusan_sidang', 'file_banding', 'file_rps'];
    foreach ($files as $file) {
        if ($request->hasFile($file)) {
            if ($kasus->$file) {
                Storage::disk('public')->delete($kasus->$file);
            }
            $filePath = $request->file($file)->store('rps_files', 'public');
            $validated[$file] = $filePath;
        } else {
            if ($kasus->$file) {
                $validated[$file] = $kasus->$file;
            }
        }
    }

    // Pisahkan hukuman_id dari validated data
    $hukuman_ids = $validated['hukuman_id'] ?? [];
    unset($validated['hukuman_id']);

    // Tambahkan user_id
    $validated['user_id'] = Auth::user()->id;

    // Update data kasus
    $kasus->update($validated);

    // Hapus data lama di tabel kasus_hukuman
    KasusHukuman::where('daftar_kasus_id', $kasus->id)->delete();

    // Insert data baru ke tabel kasus_hukuman
    foreach ($hukuman_ids as $hukuman_id) {
        KasusHukuman::insert([
            'daftar_kasus_id' => $kasus->id,
            'hukuman_id' => $hukuman_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

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
