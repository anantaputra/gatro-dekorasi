<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    
    protected $table = 'paket';

    protected $guarded = ['id'];

    public function kategorinya()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
