<?php

namespace App\Http\Controllers;

use App\Models\DaftarKasus;
use App\Models\Pangkat;
use App\Models\SKHP;
use App\Models\TamplateSKHP;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Notify; // Pastikan untuk menggunakan notify

class SKHPController extends Controller
{
    public function index()
    {
        $skhpList = SKHP::with('pangkat')->get(); // Ambil data status
        return view('page.skhp', compact('skhpList'));
    }

    // Menampilkan form untuk tambah SKHP
    public function create()
    {

        return view('page.create_skhp',[
            'pangkat'=>Pangkat::all()
        ]);
    }

    // Menyimpan SKHP baru
    public function store(Request $request)
    {
        
            $request->validate([
                'nama' => 'required|string|max:255',
                'nrp_nip' => 'required|string|max:255',
                'kesatuan_instansi' => 'required|string|max:255',
                'jabatan' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'agama' => 'required|string|max:50',
                'alamat_kantor' => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'id_pangkat' => 'required|integer|exists:pangkat,id',
                'peruntukan' => 'required|string|max:200',
                'tempat_lahir' => 'required|string|max:50',
            ]);
        
            // Menyimpan data SKHP
            $skhp = new SKHP();
            $skhp->nama = $request->nama;
            $skhp->nrp_nip = $request->nrp_nip;
            $skhp->id_pangkat = $request->id_pangkat;
            $skhp->peruntukan = $request->peruntukan;
            $skhp->tempat_lahir = $request->tempat_lahir;
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
    }

    // Menampilkan form untuk edit SKHP
    public function edit($id)
    {
        $skhp = SKHP::findOrFail($id);
        $pangkat=Pangkat::all();
        return view('page.edit_skhp', compact('skhp','pangkat'));
    }

    // Memperbarui data SKHP
    public function update(Request $request, $id)
    {
        
            $request->validate([
                'nama' => 'required|string|max:255',
                'nrp_nip' => 'required|string|max:255',
                'kesatuan_instansi' => 'required|string|max:255',
                'jabatan' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'agama' => 'required|string|max:50',
                'alamat_kantor' => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'id_pangkat' => 'required|integer|exists:pangkat,id',
                'peruntukan' => 'required|string|max:200',
                'tempat_lahir' => 'required|string|max:50',
            ]);
    
            // Update data SKHP
            $skhp = SKHP::findOrFail($id);
            $skhp->nama = $request->nama;
            $skhp->nrp_nip = $request->nrp_nip;
            $skhp->id_pangkat = $request->id_pangkat;
            $skhp->peruntukan = $request->peruntukan;
            $skhp->tempat_lahir = $request->tempat_lahir;
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
        $pangkat = Pangkat::all();

        $nrpExists = DB::table('kasus')
        ->where('nrp', (string)$skhp->nrp_nip) // Check if nrp exists
        ->count(); // Check if any record exists with this nrp
        // dd($nrpExists);
       if ($nrpExists > 0) {
        // Retrieve status IDs for 'Selesai' and 'selesai' statuses
        $statusIds = DB::table('status')
        ->whereIn('nama_status', ['Selesai', 'selesai']) // Filter by status names
        ->pluck('id'); // Use 'id' since that's the column that represents the status ID

        // Query to count records in 'kasus' table matching the status IDs and nrp
        $kasus = DB::table('kasus')
        ->where('nrp', (string)$skhp->nrp_nip) // Filter by nrp
        ->whereIn('status_id', $statusIds) // Use 'status_id' in the 'kasus' table (ensure it's correctly referencing the 'id' column from 'status')
        ->count(); // Count the number of matching records

        // Determine the status based on the count
        $status = ($kasus > 0) ? 'MEMENUHI SYARAT' : 'TIDAK MEMENUHI SYARAT';  // Reversed condition logic
       } else {
        $status = 'MEMENUHI SYARAT';
       }
       
        // 
        // Retrieve the rank name from the pangkat table using id_pangkat
        $pp = Pangkat::find($skhp->id_pangkat); // Find the rank by id_pangkat

       // Check if the rank exists
       if ($pp) {
        // Check the rank (id_pangkat) to assign the correct ttd (signing authority)
        $kabidRanks = ['AKP', 'IPTU', 'IPDA']; // Define the ranks that will have Kabid as ttd
        // dd(in_array($pp->nama_pangkat, $kabidRanks));
        $ttd = in_array($pp->nama_pangkat, $kabidRanks);
        // If the rank name is in the defined kabidRanks array, assign ttd as 'Kabid'
            // if (in_array($pp->nama_pangkat, $kabidRanks)) {
            //     $ttd = 'Kabid'; // Kabid is the signing authority
            // } else {
            //     $ttd = 'Kasubid'; // Otherwise, set ttd to Kasubid
            // }
        } else {
            // If the rank is not found, you can handle this case accordingly
            $ttd = 'Unknown Rank';
        }

        $tamplate = TamplateSKHP::find(1); // Find the rank by id_pangkat
        // Load view untuk format PDF
        $pdf = Pdf::loadView('page.skhp_pdf', compact('skhp','romanMonth','pangkat','status','tamplate','ttd'))
        ->setPaper([0, 0, 612, 1008], 'portrait'); // Ukuran Legal dalam poin

         // Stream the PDF in the browser (instead of downloading)
         return $pdf->stream('SKHP_' . $skhp->nama . '.pdf');
        // Download PDF dengan nama file yang sesuai
        // return $pdf->download('SKHP_' . $skhp->nama . '.pdf');
    }

   
}
