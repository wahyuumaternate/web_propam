<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;
    protected $table = 'pelanggaran';
    protected $guarded =['id'];

    public function kasus()
    {
        return $this->hasMany(DaftarKasus::class);
    }
}
