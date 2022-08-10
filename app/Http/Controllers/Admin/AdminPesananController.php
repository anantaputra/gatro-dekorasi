<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util\KonversiController;
use App\Models\Kategori;

class AdminPesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::latest()->paginate(10);

        $kategori = Kategori::all();
        
        return view('admin.pesanan.index', compact('pesanan', 'kategori'));
    }

    public function detail($id)
    {
        $pesanan = Pesanan::find($id);

        return view('admin.pesanan.detail', compact('pesanan'));
    }

    public function terima($id)
    {
        $pesanan = Pesanan::find($id);

        $pesanan->status = 'diterima';
        $pesanan->save();
        return redirect()->route('admin.pesanan');
    }

    public function tolak($id)
    {
        $pesanan = Pesanan::find($id);

        $pesanan->status = 'ditolak';
        $pesanan->save();
        return redirect()->route('admin.pesanan');
    }

    public function filter(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;
        $pesanan = Pesanan::whereBetween($request->tgl, [$awal, $akhir])
                    ->get();
        
        $no = 1;
        foreach($pesanan as $data){
        ?>
        <tr>
            <th scope="row"><?=$no?></th>
            <td class="text-nowrap"><?= $data->paketnya->nama?></td>
            <td><?= $data->paketnya->kategorinya->nama?></td>
            <td><?= $data->lokasi ?></td>
            <td colspan="3"><?= $data->alamat_acara ?></td>
            <td><?= KonversiController::tgl($data->tgl_acara) ?></td>
            <td><?= KonversiController::tgl($data->tgl_kembali) ?></td>
            <td>
                <?php if ($data->status == 'menunggu') {
                ?>
                <span class="badge badge-warning"><?= $data->status ?></span>                      
                <?php
                }
                elseif ($data->status == 'diterima') {
                ?>
                <span class="badge badge-success"><?= $data->status ?></span>                      
                <?php
                }
                elseif ($data->status == 'ditolak') {
                ?>
                <span class="badge badge-danger"><?= $data->status ?></span>    
                <?php
                }
                elseif ($data->status == 'menunggu DP') {
                ?>
                <span class="badge badge-primary"><?= $data->status ?></span>
                <?php
                }               
                elseif ($data->status == 'booking') {
                ?>
                <span class="badge badge-success"><?= $data->status ?></span>
                <?php
                } ?>  
            </td>
            <td>
            <?php if ($data->status == 'menunggu'){
                ?>
                <a href="{{ route('admin.pesanan.respons' , ['id' => $data->id]) }}" class="btn btn-primary">Respons</a>
                <?php
            } ?>
            </td>
        </tr>  
        <?php
            $no++;
        }
    }

    public function filterKategori(Request $request)
    {
        $pesanan = Pesanan::join('paket', 'pesanan.id_paket', '=', 'paket.id')
                    ->where('id_kategori', $request->kategori)
                    ->get();
        
        $no = 1;
        foreach($pesanan as $data){
        ?>
        <tr>
            <th scope="row"><?=$no?></th>
            <td class="text-nowrap"><?= $data->paketnya->nama?></td>
            <td><?= $data->paketnya->kategorinya->nama?></td>
            <td><?= $data->lokasi ?></td>
            <td colspan="3"><?= $data->alamat_acara ?></td>
            <td><?= KonversiController::tgl($data->tgl_acara) ?></td>
            <td><?= KonversiController::tgl($data->tgl_kembali) ?></td>
            <td>
                <?php if ($data->status == 'menunggu') {
                ?>
                <span class="badge badge-warning"><?= $data->status ?></span>                      
                <?php
                }
                elseif ($data->status == 'diterima') {
                ?>
                <span class="badge badge-success"><?= $data->status ?></span>                      
                <?php
                }
                elseif ($data->status == 'ditolak') {
                ?>
                <span class="badge badge-danger"><?= $data->status ?></span>    
                <?php
                }
                elseif ($data->status == 'menunggu DP') {
                ?>
                <span class="badge badge-primary"><?= $data->status ?></span>
                <?php
                }               
                elseif ($data->status == 'booking') {
                ?>
                <span class="badge badge-success"><?= $data->status ?></span>
                <?php
                } ?>  
            </td>
            <td>
            <?php if ($data->status == 'menunggu'){
                ?>
                <a href="{{ route('admin.pesanan.respons' , ['id' => $data->id]) }}" class="btn btn-primary">Respons</a>
                <?php
            } ?>
            </td>
        </tr>  
        <?php
        $no++;
        }
    }
}
