<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    use HasFactory;
    protected $table ='pangkat';
    protected $guarded = ['id'];

     // Define the inverse relationship to SKHP (assuming Pangkat has many SKHP records)
     public function skhp()
     {
         return $this->hasMany(SKHP::class, 'id_pangkat'); // 'id_pangkat' is the foreign key in SKHP table
     }
}
