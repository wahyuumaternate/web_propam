<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    function index() {
        return view('page.kategori',[
            'kategori'=>Kategori::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        notify()->success('Kategori Baru Berhasil Ditambahkan');
        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        notify()->success('Kategori Berhasil Diubah');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        notify()->success('Kategori Berhasil Dihapus');
        return redirect()->back();
    }


}
