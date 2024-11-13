<?php

namespace App\Http\Controllers;

use App\Models\Hukuman;
use Illuminate\Http\Request;

class HukumanController extends Controller
{
    // Fungsi untuk menampilkan halaman index hukuman
    public function index()
    {
        $hukuman = Hukuman::all();
        return view('page.hukuman', compact('hukuman'));
    }

    // Fungsi untuk menyimpan data hukuman baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_hukuman' => 'required|string|max:255',
        ]);

        Hukuman::create([
            'nama_hukuman' => $request->nama_hukuman,
        ]);

        notify()->success('Hukuman baru berhasil ditambahkan'); // Pesan berhasil

        return redirect()->route('hukuman');
    }

    // Fungsi untuk memperbarui data hukuman
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_hukuman' => 'required|string|max:255',
        ]);

        $hukuman = Hukuman::findOrFail($id);
        $hukuman->update([
            'nama_hukuman' => $request->nama_hukuman,
        ]);

        notify()->success('Hukuman berhasil diperbarui'); // Pesan berhasil

        return redirect()->route('hukuman');
    }

    // Fungsi untuk menghapus data hukuman
    public function destroy($id)
    {
        $hukuman = Hukuman::findOrFail($id);
        $hukuman->delete();

        notify()->success('Hukuman berhasil dihapus'); // Pesan berhasil

        return redirect()->route('hukuman');
    }
}
