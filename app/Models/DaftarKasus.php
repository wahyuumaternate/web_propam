<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarKasus extends Model
{
    use HasFactory;
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

   
    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class);
    }

    public function satkerSatwil()
    {
        return $this->belongsTo(Satker::class);
    }

    public function wilayahKasus()
    {
        return $this->belongsTo(WilayahKasus::class);
    }
    public function hukuman()
    {
        return $this->belongsTo(Hukuman::class);
    }
    public function pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class);
    }

    


}
