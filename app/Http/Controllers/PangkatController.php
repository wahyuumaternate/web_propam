<?php

namespace App\Http\Controllers;

use App\Models\Pangkat;
use Illuminate\Http\Request;

class PangkatController extends Controller
{
    function index() {
        return view('page.pangkat',[
            'pangkat'=>Pangkat::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pangkat' => 'required|string|max:255',
        ]);

        Pangkat::create([
            'nama_pangkat' => $request->nama_pangkat,
        ]);

        notify()->success('pangkat Baru Berhasil Ditambahkan');
        return redirect()->back()->with('success', 'pangkat berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pangkat' => 'required|string|max:255',
        ]);

        $pangkat = Pangkat::findOrFail($id);
        $pangkat->update([
            'nama_pangkat' => $request->nama_pangkat,
        ]);

        notify()->success('pangkat Berhasil Diubah');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $pangkat = Pangkat::findOrFail($id);
        $pangkat->delete();
        notify()->success('pangkat Berhasil Dihapus');
        return redirect()->back();
    }
}
