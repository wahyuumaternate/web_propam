<?php

namespace App\Http\Controllers;

use App\Models\TamplateSKHP;
use Illuminate\Http\Request;

class TamplateSKHPController extends Controller
{
    function index() {
        $tamplateSkhp = TamplateSkhp::findOrFail(1); // Retrieve the record to be edited

        return view('page.tamplate_skhp',compact('tamplateSkhp'));
    }
    // Update an existing record
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'di_keluar_di' => 'required|string|max:255',
            'kabid_nama' => 'required|string|max:255',
            'kabid_pangkat' => 'required|string|max:255',
            'kabid_nrp' => 'required|string|max:255',
            'kasubid_nama' => 'required|string|max:255',
            'kasubid_pangkat' => 'required|string|max:255',
            'kasubid_nrp' => 'required|string|max:255',
        ]);

        // Find and update the existing record
        $tamplateSkhp = TamplateSkhp::findOrFail($id);
        $tamplateSkhp->update([
            'di_keluar_di' => $validated['di_keluar_di'],
            'kabid_nama' => $validated['kabid_nama'],
            'kabid_pangkat' => $validated['kabid_pangkat'],
            'kabid_nrp' => $validated['kabid_nrp'],
            'kasubid_nama' => $validated['kasubid_nama'],
            'kasubid_pangkat' => $validated['kasubid_pangkat'],
            'kasubid_nrp' => $validated['kasubid_nrp'],
        ]);

        // Redirect with success message
         // Menggunakan Laravel Notify untuk notifikasi sukses
         notify()->success('Tamplate SKHP Update successfully.');
        return redirect()->back();
    }
}
