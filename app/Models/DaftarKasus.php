<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarKasus extends Model
{
    protected $table ='kasus';
    protected $guarded =['id'];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }


}
