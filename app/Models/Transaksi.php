<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    // semua boleh diisi
    protected $guarded = [];

    // menonaktfikan increment
    public $incrementing = false;
    
    // menjadikan kd_transaksi primary key untuk d panggil di Controller (find($kd_transaksi))
    protected $primaryKey = 'kd_transaksi';

    public function pesanannya()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}
