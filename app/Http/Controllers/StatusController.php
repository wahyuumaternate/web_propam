<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    function index() {
        return view('page.status',[
            'status'=>Status::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_status' => 'required|string|max:255',
        ]);

        Status::create([
            'nama_status' => $request->nama_status,
        ]);

        notify()->success('status Baru Berhasil Ditambahkan');
        return redirect()->back()->with('success', 'status berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_status' => 'required|string|max:255',
        ]);

        $status = Status::findOrFail($id);
        $status->update([
            'nama_status' => $request->nama_status,
        ]);

        notify()->success('status Berhasil Diubah');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $status = Status::findOrFail($id);
        $status->delete();
        notify()->success('status Berhasil Dihapus');
        return redirect()->back();
    }
}
