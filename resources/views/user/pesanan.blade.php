@extends('layouts.detail')

@section('content')

<div class="w-100 row">

    @include('navigation.sidebar-user')

    <div id="content" class="p-4">

        <div class="mt-1">
            <h3>Pesanan</h3>
            <div class="mt-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
                    </ol>
                </nav>
            </div>
          </div>

        @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Sabar ya</h4>
            <p>{{ Session::get('success') }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <table class="table table-bordered">
            <thead>
              <tr>
                <td scope="col">No</td>
                <td scope="col">Nama Paket</td>
                <td scope="col">Lokasi Acara</td>
                <td scope="col">Tanggal Acara</td>
                <td scope="col">Tanggal Pengembalian</td>
                <td scope="col">Catatan</td>
                <td scope="col">Status</td>
                @if (isset($pesanan[0]->status))
                <td scope="col">Pesanan</td>
                @endif
              </tr>
            </thead>
            
            <tbody>
                @php
                    $no = 1;
                @endphp
                    @if (isset($pesanan))
                        @foreach ($pesanan as $data)
                            <tr>
                                <th scope="row">{{$no}}</th>
                                <td>{{ $data->paketnya->nama}}</td>
                                <td>{{ $data->lokasi }}</td>
                                <td>{{ App\Http\Controllers\Util\KonversiController::tgl($data->tgl_acara) }}</td>
                                <td>{{ App\Http\Controllers\Util\KonversiController::tgl($data->tgl_kembali) }}</td>
                                <td>{{ $data->catatan }}</td>
                                <td>{{ $data->status }}</td>
                                <td>
                                    @if ($data->status == 'menunggu')
                                        <a href="{{ route('user.pesanan.batal', ['id' => $data->id]) }}" role="button" class="btn btn-danger">Batalkan Pesanan</a>
                                    @endif
                                    @if ($data->status == 'diterima')
                                        <a href="{{ route('user.konfirmasi', ['id' => $data->id]) }}" role="button" class="btn btn-primary">Bayar</a>
                                    @endif
                                    @if ($data->status == 'booking')
                                        <a href="{{ route('user.cetak.nota', ['id' => $data->id]) }}" role="button" class="btn btn-success">Cetak Nota</a>
                                    @endif
                                </td>
                            </tr>
                        @php
                            $no++;
                        @endphp
                        @endforeach
                    @endif
            </tbody>
          </table>
    </div>
</div>

@endsection