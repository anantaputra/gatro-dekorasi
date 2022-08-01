@extends('layouts.app')

@section('content')

{{-- template bagian kanan halaman --}}
<div class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="pr-5">
    <div class="container pr-5">
      <div class="mt-4">
        <h3>Pengembalian</h3>
        <div class="mt-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Admin</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Pengembalian</li>
                </ol>
            </nav>
        </div>
      </div>

      <div class="mt-3">
          <table class="table">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Customer</th>
                  <th scope="col">Tanggal Acara</th>
                  <th scope="col">Tanggal Pengembalian</th>
                  <th scope="col">Alamat Acara</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($pengembalian as $item)    
                <tr>
                  <td>{{ $no }}</td>
                  <td>{{ $item->usernya->name }}</td>
                  <td>{{ date("d-m-Y", strtotime($item->tgl_acara)) }}</td>
                  <td>{{ date("d-m-Y", strtotime($item->tgl_kembali)) }}</td>
                  <td>{{ $item->alamat_acara }}</td>
                  <td>
                    {{ $status = App\Http\Controllers\Admin\AdminPengembalianController::status($item->id) }}
                    @if ($status != 'Selesai')
                    <a class="btn btn-primary" href="{{ route('admin.pengembalian.form', ['id' => $item->id]) }}" role="button">Konfirmasi</a>
                    @endif
                  </td>
                </tr>
                @php
                $no++;
                @endphp
                @endforeach
                
              </tbody>
            </table>      
      </div>
    </div>
  </div>

</div>

@endsection