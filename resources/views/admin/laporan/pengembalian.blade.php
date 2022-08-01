@extends('layouts.app')

@section('content')

{{-- template bagian kanan halaman --}}
<div class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="container">
    <h3 class="mt-4">Laporan pengembalian</h3>
    <div class="mt-3">
      <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <div class="d-flex col-10 align-items-center">
          <span>Filter: </span>
          <input type="date" name="tgl_awal" class="form-control col-2 ml-3">
          <span class="ml-3">s.d</span>
          <input type="date" name="tgl_akhir" class="form-control col-2 ml-3" onchange="filter()">
        </div>
        <a href="" onclick="cetak()" class="d-flex align-items-center btn btn-success">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
            <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
            <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
          </svg>
          <span class="ml-2">Cetak</span>
        </a>
      </div>
        <table class="table">
            <thead>
              <tr>
                <th class="align-middle">No</th>
                <th class="align-middle">Nama Customer</th>
                <th class="align-middle">Nama Paket</th>
                <th class="align-middle">Harga Paket</th>
                <th class="align-middle">Tanggal Kembali</th>
                <th class="align-middle">Lokasi Acara</th>
                <th class="align-middle">Denda</th>
                <th class="align-middle">Biaya Denda</th>
              </tr>
            </thead>
            <tbody id="tbody">
              @if (isset($pengembalian))    
              @php
                  $no = 1;
              @endphp
              @foreach ($pengembalian as $item)
              <tr>
                <td>{{ $no }}</td>
                <td>{{ $item->pesanannya->usernya->name }}</td>
                <td>{{ $item->pesanannya->paketnya->nama }}</td>
                <td>Rp{{ number_format($item->pesanannya->paketnya->harga, 0, '', '.') }}</td>
                <td>{{ date("d/m/Y", strtotime($item->pesanannya->tgl_kembali)) }}</td>
                <td>{{ $item->pesanannya->alamat_acara }}</td>
                <td>{{ ($item->denda != null) ? 'Iya' : 'Tidak' }}</td>
                <td>
                    @if ($item->denda != null)
                    Rp{{ number_format($item->denda, 0, '', '.') }}
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
        <div class="d-flex justify-content-end px-5 mx-5">
          {!! $pengembalian->links() !!}
        </div>
    </div>
  </div>
</div>

<script>
  function cetak(){
    window.open("{{ route('admin.laporan.pengembalian.cetak') }}");
  }
</script>

<script>
  var awal = document.querySelector('input[type=date][name=tgl_awal]');
  var akhir = document.querySelector('input[type=date][name=tgl_akhir]');
  function filter(){
    if(awal.value != null){
      $.ajax({
        url: "{{ route('filter.kembali') }}",
        type: "post",
        data: {
          _token: "{{ csrf_token() }}",
          awal: awal.value,
          akhir: akhir.value
        },
        success: function(data){
          document.querySelector('#tbody').innerHTML = data;
        }
      });
    }
  }
</script>

@endsection