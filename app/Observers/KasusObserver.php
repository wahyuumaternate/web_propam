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
            'description' => 'Buat Kasus dengan nama pelanggar ' . $kasus->nama
        ]);
    }

    public function updated(DaftarKasus $kasus)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Ubah data Kasus dengan nama pelanggar ' . $kasus->nama
        ]);
    }

    public function deleted(DaftarKasus $kasus)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => 'Hapus Kasus dengan nama pelanggar ' . $kasus->nama
        ]);
    }
}
