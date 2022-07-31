@extends('layouts.detail')

@section('content')

<div class="container">
    @if (auth()->user()->is_admin != 1)    
    <div class="w-100 mt-3 breadcrumb bg-white">
        <li class="breadcrumb-item ml-5"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item">{{ $paket->kategorinya->nama }}</li>
        <li class="breadcrumb-item active" aria-current="page">{{ $paket->nama }}</li>
    </div>
    @else
    <div class="w-100 mt-3 breadcrumb bg-white">
        <li class="breadcrumb-item ml-5"><a href="{{ route('admin.produk') }}">Daftar Paket</a></li>
        <li class="breadcrumb-item">{{ $paket->kategorinya->nama }}</li>
        <li class="breadcrumb-item active" aria-current="page">{{ $paket->nama }}</li>
    </div>
    @endif
    
    <div class="px-5">
    
        <div class="kiri">
            <div class="px-2">
                <img id="model-img" src="{{ asset('img/model.jpg') }}" width="550px" height="400px">
                <div class="w-100 d-flex mt-3">   
                    <?php $i = 1; ?>
                    @foreach ($gambar as $image)
                        <img onclick="showModel({{$i}})" id="img-sm-{{$i}}" src="{{ asset('paket/detail/'.$image->img.'')}}" width="80px" height="80px">
                        <div class="mr-3"></div>
                        <?php $i++; ?>
                    @endforeach
                </div>
            </div>
        </div>
    
        <div class="mx-auto"></div>
    
        <div class="kanan">
            <div class="w-100">
                <h4><b>{{ $paket->nama }}</b></h4>
            </div>

            <div id="accordion mt-3">
                <div class="card" style="border-color: #c88a72">
              
                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                      <div class="card-body mt-3 d-flex justify-content-center">
                          
                            @php
                                $harga = $paket->harga;
                                $harga = number_format($harga, 0, '', '.');
                            @endphp
                            Rp. {{ $harga }}</b></h4>
                      </div>
                      @if ($paket->jml_tamu != null)
                      <hr width="100px" class="col-md-5 offset-md-3">
                      <div class="mx-3 d-flex justify-content-between">
                        <p>Jumlah Tamu </p>
                        <p>-/+ {{ $paket->jml_tamu}}</p>
                      </div>
                      @endif
                    </div>
                </div>
                @if (auth()->user()->is_admin != 1)
                <div class="mt-4 mr-4">
                    <a href="https://wa.me/{{ env('no_wa') }}" role="button" class="btn" style="width: 40%; background-color:#c88a72;"><img src="{{ asset('img/chat.png')}}" style="color: white" width="18" height="20" alt=""> Chat</button>
                        
                    <a href="{{ route('pesan-sekarang', ['id' => $paket->id]) }}" role="button" id="pesan" class="btn mx-1" style="width: 50%; background-color:#c88a72;">Pesan Sekarang</a>
                </div>
                @endif

                <div class="mt-3 ">
                    <hr>
                    <p><b>Details</b> </p><hr>
                </div>
                <div id="collapseOne" class="collapse show " data-parent="#accordion">
                    <div class="card-body font-weight-light">
                        @if (isset($paket->deskripsi))
                            {!! $paket->deskripsi !!}
                            
                        @endif
                        @php
                            $detail     = $paket->isi_paket;
                            $detail     = explode(',', $detail);
                            $keterangan = $paket->keterangan;
                            $keterangan = explode(',', $keterangan); 
                        @endphp
                        <table>
                            @foreach ($detail as $key => $value)
                            <tr>
                                    @if($detail[$key] != '' && $keterangan[$key] != '')
                                    <td>
                                        <span>{{ $detail[$key] }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $keterangan[$key] }}</span>
                                    </td>
                                    @else
                                    <td>
                                        <span>{{ $detail[$key] }}</span>
                                    </td>
                                    <td>
                                    </td>
                                    @endif
                            </tr>
                            @endforeach
                        </table>
                      </div>
                </div>
            </div>
        </div>
    
        
           
    
    </div>
    
</div>

<script>
    function nl2br(str){
        return str.replace(/(?:\r\n|\r|\n)/g, '<br>');
    }
    var str = document.querySelector('#isi_paket').innerHTML;
    document.querySelector('#isi_paket').innerHTML = nl2br(str);
</script>

<script>
    var url = document.getElementById('img-sm-1').src;
    document.getElementById('model-img').src = url;
    function showModel(id){
        var url = document.getElementById('img-sm-'+id).src;
        document.getElementById('model-img').src = url;
    }
</script>
    
@endsection