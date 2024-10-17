<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table ='kategori';
    protected $guarded = ['id'];


    public function kasus()
    {
        return $this->hasMany(DaftarKasus::class);
    }
}
