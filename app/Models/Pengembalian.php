<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';

    protected $guarded = ['id'];

    public function pesanannya()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id');
    }
}
