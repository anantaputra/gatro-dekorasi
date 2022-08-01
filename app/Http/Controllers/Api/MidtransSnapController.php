<?php

namespace App\Http\Controllers\Api;

use Midtrans\Snap;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pesanan;

class MidtransSnapController extends Controller
{
    public static function snap($kd_transaksi, $total, $nama, $email)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-b6rcWtmyXKvX39nh70fMzV5P';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        
        $params = array(
            'transaction_details' => array(
                'order_id' => $kd_transaksi,
                'gross_amount' => $total,
            ),
            'customer_details' => array(
                'first_name' => $nama,
                'email' => $email
            ),
        );
        
        $snapToken = Snap::getSnapToken($params); // memanggil fungsi snap yang sudah disediakan midtrans package untuk mendapatkan token

        return $snapToken; // mengembalikan token yang sudah digenerate diatas
    }
    
    public function handler(Request $request)
    {
        $json = json_decode($request->getContent());
        $signature = hash('sha512', $json->order_id . $json->status_code . $json->gross_amount . env('MIDTRANS_SERVER_KEY_NO_HASH'));

        if($signature != $json->signature_key){
            abort(401);
        }

        $transaksi = Transaksi::find($json->order_id);
        $transaksi->status = $json->transaction_status;
        $pesanan = Pesanan::find($transaksi->id_pesanan);
        $pesanan->status = 'booking';
        $pesanan->save();
        return $transaksi->save();

    }
}
