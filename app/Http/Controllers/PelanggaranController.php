<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    // Fungsi untuk menampilkan halaman index pelanggaran
    public function index()
    {
        $pelanggaran = Pelanggaran::all();
        return view('page.pelanggaran', compact('pelanggaran')); // Pastikan Anda memiliki view pelanggaran.index
    }

    // Fungsi untuk menyimpan data pelanggaran baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggaran' => 'required|string|max:255',
        ]);

        Pelanggaran::create([
            'nama_pelanggaran' => $request->nama_pelanggaran,
        ]);

        notify()->success('Pelanggaran baru berhasil ditambahkan'); // Pesan berhasil

        return redirect()->route('pelanggaran');
    }

    // Fungsi untuk memperbarui data pelanggaran
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggaran' => 'required|string|max:255',
        ]);

        $pelanggaran = Pelanggaran::findOrFail($id);
        $pelanggaran->update([
            'nama_pelanggaran' => $request->nama_pelanggaran,
        ]);

        notify()->success('Pelanggaran berhasil diperbarui'); // Pesan berhasil

        return redirect()->route('pelanggaran');
    }

    // Fungsi untuk menghapus data pelanggaran
    public function destroy($id)
    {
        $pelanggaran = Pelanggaran::findOrFail($id);
        $pelanggaran->delete();

        notify()->success('Pelanggaran berhasil dihapus'); // Pesan berhasil

        return redirect()->route('pelanggaran');
    }
}
