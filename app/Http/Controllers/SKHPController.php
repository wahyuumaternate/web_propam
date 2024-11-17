<?php

namespace App\Http\Controllers;

use App\Models\SKHP;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Notify; // Pastikan untuk menggunakan notify

class SKHPController extends Controller
{
    public function index()
    {
        $skhpList = SKHP::all(); // Ambil data status
        return view('page.skhp', compact('skhpList'));
    }

    // Menampilkan form untuk tambah SKHP
    public function create()
    {
        return view('page.create_skhp');
    }

    // Menyimpan SKHP baru
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'pangkat_nrp_nip' => 'required|string|max:255',
                'kesatuan_instansi' => 'required|string|max:255',
                'jabatan' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'agama' => 'required|string|max:50',
                'alamat_kantor' => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            ]);
        
            // Menyimpan data SKHP
            $skhp = new Skhp();
            $skhp->nama = $request->nama;
            $skhp->pangkat_nrp_nip = $request->pangkat_nrp_nip;
            $skhp->kesatuan_instansi = $request->kesatuan_instansi;
            $skhp->jabatan = $request->jabatan;
            $skhp->agama = $request->agama;
            $skhp->alamat_kantor = $request->alamat_kantor;
            $skhp->jenis_kelamin = $request->jenis_kelamin; // Menyimpan jenis kelamin
            $skhp->tanggal_lahir = $request->tanggal_lahir; // Menyimpan jenis kelamin
            $skhp->save();
    
            // Menggunakan Laravel Notify untuk notifikasi sukses
            notify()->success('SKHP created successfully.');
            return redirect()->route('skhp.index');
        } catch (\Throwable $th) {
            notify()->error($th->getMessage());
            return redirect()->back();
            //throw $th;
        }
    }

    // Menampilkan form untuk edit SKHP
    public function edit($id)
    {
        $skhp = SKHP::findOrFail($id);
        return view('page.edit_skhp', compact('skhp'));
    }

    // Memperbarui data SKHP
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'pangkat_nrp_nip' => 'required|string|max:255',
            'kesatuan_instansi' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:50',
            'alamat_kantor' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        // Update data SKHP
        $skhp = SKHP::findOrFail($id);
        $skhp->nama = $request->nama;
        $skhp->pangkat_nrp_nip = $request->pangkat_nrp_nip;
        $skhp->kesatuan_instansi = $request->kesatuan_instansi;
        $skhp->jabatan = $request->jabatan;
        $skhp->agama = $request->agama;
        $skhp->alamat_kantor = $request->alamat_kantor;
        $skhp->jenis_kelamin = $request->jenis_kelamin; // Menyimpan jenis kelamin
        $skhp->tanggal_lahir = $request->tanggal_lahir; // Menyimpan jenis kelamin
        $skhp->save();

        // Menggunakan Laravel Notify untuk notifikasi sukses
        notify()->success('SKHP updated successfully.');
        return redirect()->route('skhp.index');
    }

    // Menghapus data SKHP
    public function destroy($id)
    {
        $skhp = SKHP::findOrFail($id);
        $skhp->delete();
        
        // Menggunakan Laravel Notify untuk notifikasi sukses
        notify()->success('SKHP deleted successfully.');
        return redirect()->route('skhp.index');
    }

        public function downloadPDF($id)
    {
        // Ambil data SKHP berdasarkan ID
        $skhp = SKHP::findOrFail($id);

        $romanMonths = [
            1 => 'I',  2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 
            6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X',
            11 => 'XI', 12 => 'XII'
        ];
    
        $currentMonth = (int) date('m');
        $romanMonth = $romanMonths[$currentMonth];

        // Load view untuk format PDF
        $pdf = Pdf::loadView('page.skhp_pdf', compact('skhp','romanMonth'))
        ->setPaper([0, 0, 612, 1008], 'portrait'); // Ukuran Legal dalam poin

         // Stream the PDF in the browser (instead of downloading)
         return $pdf->stream('SKHP_' . $skhp->nama . '.pdf');
        // Download PDF dengan nama file yang sesuai
        // return $pdf->download('SKHP_' . $skhp->nama . '.pdf');
    }
}
