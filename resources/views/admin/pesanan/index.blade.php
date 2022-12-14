@extends('layouts.app')

@section('content')

{{-- template bagian kanan halaman --}}
<div class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-2">
  <div class="pr-5">
    <div class="container pr-5">
      <div class="mt-4">
        <h3>Penyewaan</h3>
        <div class="mt-4">
          <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Penyewaan</li>
              </ol>
          </nav>
        </div>
      </div>
      <div class="mt-3">
        <div class="d-flex w-100 justify-content-between align-items-center mb-2">
          <div class="d-flex align-items-center">
            <span>Filter: </span>
            <select name="tgl" id="tgl" class="form-control ml-3"> <!--ini adl element select yg name nya tgl-->
              <option value="0" selected disabled>-Pilih-</option>
              <option value="tgl_acara">Tanggal Acara</option>
              <option value="tgl_kembali">Tanggal Pengembalian</option>
            </select>
            <input type="date" name="tgl_awal" class="form-control ml-3"> <!--ini adl element input yg name nya tgl_awal-->
            <span class="ml-3">s.d</span>
            <input type="date" name="tgl_akhir" class="form-control ml-3" onchange="filter()"> <!--ini adl element input yg name nya tgl_akhir-->
          </div>
          <div class="d-flex align-items-center justify-content-end">
            <span>Kategori: </span>
            <select name="kategori" id="kategori" class="form-control ml-3" onchange="filterKategori()">
              <option value="0" selected disabled>-Pilih-</option>
              @foreach ($kategori as $item)
              <option value="{{ $item->id }}">{{ $item->nama }}</option>
              @endforeach
            </select>
          </div>
        </div>
          <table class="table">
              <thead>
                <tr>
                  <td scope="col">No</td>
                  <td scope="col" class="text-nowrap">Nama Paket</td>
                  <td scope="col" class="text-nowrap">Kategori Paket</td>
                  <td scope="col" class="text-nowrap">Lokasi Acara</td>
                  <td scope="col" class="text-nowrap" colspan="3">Alamat Lokasi</td>
                  <td scope="col" class="text-nowrap">Tanggal Acara</td>
                  <td scope="col" class="text-nowrap">Tanggal Pengembalian</td>
                  <td scope="col">Status</td>
                  <td scope="col">Aksi</td>
                </tr>
              </thead>
              <tbody id="tbody"> <!--Elment dengan id tbody-->
                @php
                    $no = 1;
                @endphp
                @if (isset($pesanan))
                @foreach ($pesanan as $data)  
                <tr>
                    <th scope="row">{{$no}}</th>
                    <td class="text-nowrap">{{ $data->paketnya->nama}}</td>
                    <td>{{ $data->paketnya->kategorinya->nama}}</td>
                    <td>{{ $data->lokasi }}</td>
                    <td colspan="3">{{ $data->alamat_acara }}</td>
                    <td>{{ App\Http\Controllers\Util\KonversiController::tgl($data->tgl_acara) }}</td>
                    <td>{{ App\Http\Controllers\Util\KonversiController::tgl($data->tgl_kembali) }}</td>
                    <td>
                      @if ($data->status == 'menunggu')
                      <span class="badge badge-warning">{{ $data->status }}</span>                      
                      @elseif ($data->status == 'diterima')
                      <span class="badge badge-success">{{ $data->status }}</span>                      
                      @elseif ($data->status == 'ditolak')
                      <span class="badge badge-danger">{{ $data->status }}</span>    
                      @elseif ($data->status == 'dibatalkan')
                      <span class="badge badge-danger">{{ $data->status }}</span>    
                      @elseif ($data->status == 'menunggu DP')                  
                      <span class="badge badge-secondary">{{ $data->status }}</span>
                      @elseif ($data->status == 'booking')                  
                      <span class="badge badge-info">{{ $data->status }}</span>
                      @endif
                    </td>
                    <td>
                    @if ($data->status == 'menunggu')
                      <a href="{{ route('admin.pesanan.respons' , ['id' => $data->id]) }}" class="btn btn-primary">Respons</a>
                    @elseif ($data->status == ('booking' || 'diterima'))
                    <a href="{{ route('admin.pesanan.respons' , ['id' => $data->id]) }}" class="btn btn-outline-dark">Detail</a>
                    @endif
                    </td>
                </tr>
                <?php $no++; ?>
                @endforeach
                @endif
              </tbody>
            </table>
      
      </div>
    </div>
  </div>
  <div class="d-flex justify-content-end px-5 mx-5">
    {!! $pesanan->links() !!}
  </div>
</div>

<script>
  var tgl = document.querySelector('select[name=tgl]'); // buat variable tgl yg isinya element select dengan name tgl
  var awal = document.querySelector('input[type=date][name=tgl_awal]'); // buat variable tgl yg isinya element input type date dengan name tgl_awal
  var akhir = document.querySelector('input[type=date][name=tgl_akhir]'); // buat variable tgl yg isinya element input type date dengan name tgl_akhir
  function filter(){
    if(tgl.value != 0 && awal.value != null){
      $.ajax({ // memanggil fungsi ajax untuk send data atau form pada jquery
        url: "{{ route('admin.pesanan.filter') }}", // url atau tujuan data dikirim ke route admin.pesanan.filter
        type: "post", // tipe pengiriman data atau form berupa post
        data: { // isi data atau form yg dikirimkan
          _token: "{{ csrf_token() }}", // csrf token
          tgl: tgl.value,
          awal: awal.value,
          akhir: akhir.value
        },
        success: function(data){ // ketika sukses maka jalankan fungsi 
          document.querySelector('#tbody').innerHTML = data; // isi HTML dari element dengan id tbody ditimpa dengan data yang didapatkan dari proses pengiriman form
          // console.log(data)
        }
      });
    }
  }
</script>

<script>
  var kategori = document.querySelector('select[name=kategori]');
  function filterKategori(){
    $.ajax({
      url: "{{ route('admin.pesanan.filter.kategori') }}",
      type: 'post',
      data: {
        _token : "{{ csrf_token() }}",
        kategori: kategori.value
      },
      success: function(data){
        document.querySelector('#tbody').innerHTML = data;
      }
    })
  }
</script>

@endsection