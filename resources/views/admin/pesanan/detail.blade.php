@extends('layouts.app')

@section('content')

{{-- template bagian kanan halaman --}}
<div class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="pr-5">
    <div class="container pr-5">
      <div class="mt-4">
        <h3>Pesanan Masuk</h3>
        <div class="mt-4">
          <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.pesanan') }}">Pesanan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pesanan Masuk</li>
              </ol>
          </nav>
        </div>
      </div>
      <div class="mt-3">
        <div>Nama Paket : {{ $pesanan->paketnya->nama}}</div>
        <div>Kategori: {{ $pesanan->paketnya->kategorinya->nama }}</div>
        <div>Harga: Rp {{ number_format($pesanan->paketnya->harga, 0, '', '.') }}</div>
        <div>Lokasi Acara: {{ $pesanan->lokasi }}</div>
        <div>Alamat Lokasi: {{ $pesanan->alamat_acara }}</div>
        <div>Tanggal Acara: {{ App\Http\Controllers\Util\KonversiController::tgl($pesanan->tgl_acara) }}</div>
        <div>Tanggal Pengembalian: {{ App\Http\Controllers\Util\KonversiController::tgl($pesanan->tgl_kembali) }}</div>
        <div>Catatan: {{ $pesanan->catatan }}</div>
        <div>Status: {{ $pesanan->status }}</div>
        <div>
            @if ($pesanan->status == "menunggu")
            <a href="{{ route('admin.pesanan.terima', ['id' => $pesanan->id]) }}" role="button" class="btn btn-success">Terima</a>
            <a href="{{ route('admin.pesanan.tolak', ['id' => $pesanan->id]) }}" role="button" class="btn btn-danger">Tolak</a>
            @endif
        </div>
      </div>
    </div>
  </div>

</div>

@endsection