<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $guarded = [];

    public $incrementing = false;
    
    protected $primaryKey = 'kd_transaksi';

    public function pesanannya()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}
