<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table ='status';
    public function kasus()
    {
        return $this->hasMany(DaftarKasus::class);
    }
}
