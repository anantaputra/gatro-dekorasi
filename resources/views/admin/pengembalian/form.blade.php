@extends('layouts.app')

@section('content')

<div class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="pr-5">
        <div class="container pr-5">
            <div class="mt-4">
              <h3>Form Pengembalian</h3>
            </div>
            <form method="POST" action="{{ route('admin.pengembalian.simpan') }}">
                @csrf
                <input type="hidden" name="id_pesanan" value="{{ $pesanan->id }}">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="nama-pemesan">Nama Customer</label>
                    <input type="text" class="form-control" value="{{ $pesanan->usernya->name }}" id="nama-pemesan" readonly>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="no-telp">Telepon Customer</label>
                    <input type="text" class="form-control" value="{{ $pesanan->usernya->no_hp1 }}" id="no-telp" readonly>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="tgl-acara">Tgl Acara</label>
                    <input type="date" class="form-control" value="{{ $pesanan->tgl_acara }}" id="tgl-acara" readonly>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="tgl-kembali">Tgl Kembali</label>
                    <input type="date" class="form-control" value="{{ $pesanan->tgl_kembali }}" id="tgl-kembali" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="alamat-lokasi">Alamat Lokasi</label>
                  <input type="text" class="form-control" id="alamat-lokasi" value="{{ $pesanan->alamat_acara }}" readonly>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="nama-paket">Paket</label>
                    <input type="text" class="form-control" id="nama-paket" value="{{ $pesanan->paketnya->nama }}" readonly>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="harga-paket">Harga Paket</label>
                    <input type="text" class="form-control" id="harga-paket" value="Rp. {{ number_format($pesanan->paketnya->harga, 0, '', '.') }}" readonly>
                  </div>
                </div>
                <div class="form-group">
                    <label for="denda">Denda</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" class="form-control" id="inlineFormInputGroup" name="denda" placeholder="Nominal Denda">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>
</div>

@endsection