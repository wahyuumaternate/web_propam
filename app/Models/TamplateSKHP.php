<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TamplateSKHP extends Model
{
    use HasFactory;
    protected $table = 'tamplate_skhp';
    protected $guarded =['id'];
}
