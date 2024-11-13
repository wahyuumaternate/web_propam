<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SKHP extends Model
{
    use HasFactory;
    protected $table = 'skhp';
    protected $guarded =['id'];
}
