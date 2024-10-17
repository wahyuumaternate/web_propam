<?php

namespace App\Http\Controllers;

use App\Models\Satker;
use Illuminate\Http\Request;

class SatkerController extends Controller
{
    function index() {
        return view('page.satker',[
            'satker'=>Satker::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_satker_satwil' => 'required|string|max:255',
        ]);

        Satker::create([
            'nama_satker_satwil' => $request->nama_satker_satwil,
        ]);

        notify()->success('satker Baru Berhasil Ditambahkan');
        return redirect()->back()->with('success', 'satker berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_satker_satwil' => 'required|string|max:255',
        ]);

        $satker = Satker::findOrFail($id);
        $satker->update([
            'nama_satker_satwil' => $request->nama_satker_satwil,
        ]);

        notify()->success('satker Berhasil Diubah');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $satker = Satker::findOrFail($id);
        $satker->delete();
        notify()->success('satker Berhasil Dihapus');
        return redirect()->back();
    }
}
