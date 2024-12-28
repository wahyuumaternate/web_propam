<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hukuman extends Model
{
    use HasFactory;

    protected $table = 'hukuman';
    protected $guarded =['id'];

    public function kasus()
    {
        return $this->hasMany(DaftarKasus::class);
    }
}
