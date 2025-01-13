<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\DaftarKasus;
use Illuminate\Support\Facades\Auth;

class KasusObserver
{
    public function created(DaftarKasus $kasus)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => 'Buat Kasus dengan nama pelanggar ' . $kasus->nama,
            'created_at' => now()->timezone('Asia/Jayapura'), // Set to Indonesia Eastern Time
            'updated_at' => now()->timezone('Asia/Jayapura')  // Set to Indonesia Eastern Time
        ]);
    }

    // public function updated(DaftarKasus $kasus)
    // {
    //     ActivityLog::create([
    //         'user_id' => Auth::id(),
    //         'action' => 'update',
    //         'description' => 'Ubah data Kasus dengan nama pelanggar ' . $kasus->nama
    //     ]);
    // }

    public function updated(DaftarKasus $kasus)
    {
        // $originalData = $kasus->getOriginal();
        // $changes = $kasus->getChanges();

        // $description = 'Ubah data Kasus dengan nama pelanggar ' . $kasus->nama . '. Perubahan: ';
        $description = 'Ubah data Kasus dengan nama pelanggar ' . $kasus->nama;
        // foreach ($changes as $field => $newValue) {
        //     $oldValue = $originalData[$field];
        //     $description .= "$field dari '$oldValue' menjadi '$newValue'; ";
        // }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => $description,
            'created_at' => now()->timezone('Asia/Jayapura'), // Set to Indonesia Eastern Time
            'updated_at' => now()->timezone('Asia/Jayapura')  // Set to Indonesia Eastern Time
        ]);
    }

    public function deleted(DaftarKasus $kasus)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => 'Hapus Kasus dengan nama pelanggar ' . $kasus->nama,
            'created_at' => now()->timezone('Asia/Jayapura'), // Set to Indonesia Eastern Time
            'updated_at' => now()->timezone('Asia/Jayapura')  // Set to Indonesia Eastern Time
        ]);
    }
}
