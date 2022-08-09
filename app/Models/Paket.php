<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    
    protected $table = 'paket';

    //kolom yg tdk boleh diisi
    protected $guarded = ['id'];

    public function kategorinya()
    {
        //yg menjadi diagram relasi (beberapa) tabel paket memiliki 1 kategori (M to 1) 
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }

    public function banner()
    {
        //relasinya tabel paket memiliki 1 gambar (1 to 1)
        return $this->hasOne(GambarPaket::class, 'id_paket', 'id');
    }
}
