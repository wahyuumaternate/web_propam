<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasusHukuman extends Model
{
    use HasFactory;
    protected $table = 'kasus_hukuman';

    protected $guarded = ['id'];

    public function kasus()
    {
        return $this->belongsTo(DaftarKasus::class, 'daftar_kasus_id');
    }

    public function hukuman()
    {
        return $this->belongsTo(Hukuman::class, 'hukuman_id');
    }
}
