<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hukuman extends Model
{

    use HasFactory;

    protected $table = 'hukuman';
    protected $guarded =['id'];

   
    public function kasusHukuman()
    {
        return $this->belongsToMany(DaftarKasus::class, 'kasus_hukuman');
    }
}