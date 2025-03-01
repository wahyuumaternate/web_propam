<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satker extends Model
{
    use HasFactory;
    protected $table ='satker_satwil';
    protected $guarded =['id'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
