@extends('layouts.detail')

@section('content')


    <div class="card w-50 mt-4 mx-auto" >
        <div class="card-body">
            <a href="{{ route('home')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                </svg> 
            </a> <h5>YOUR ORDER</h5> 
        </div>
    </div>
    <div class="card w-50 mt-3 mx-auto" >
        <div class="card-body">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" style="color: #704c3e" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            </svg> Alamat 
            <p class="ml-4"> {{ $pesanan->nama }} {{ (isset($pesanan->usernya->no_hp1)) ? $pesanan->usernya->no_hp1 : '' }} <br> {{ $pesanan->lokasi}} <br> {{ $pesanan->alamat_acara }} </p>
            <p class="ml-4"> </p>
        </div>
    </div>
    <div class="card w-50 mt-4 mx-auto" >
        <div class="card-body">
            Paket Disewa <hr>
            <div class="d-flex">
                <div class="mr-auto p-2"></div>
                <div class="p-2 "></div>
                <div class="pr-5 mr-5" style="color: rgb(175, 174, 174)">Jumlah</div>
                <div class="px-2 pb-2" style="color: rgb(175, 174, 174)">Total</div>
            </div>
            <div class="d-flex">
                <div class="mr-auto p-2">{{ $pesanan->paketnya->nama }}</div>
                <div class="p-2"></div>
                <div class="p-2 mr-5">1</div>
                <div class="p-2">Rp{{ number_format($pesanan->paketnya->harga, 0, '', '.') }}</div>
            </div>
            <div class="mr-auto p-2" style="color: rgb(139, 139, 139)">Catatan</div>
            <p class="p-2">{{ $pesanan->catatan }}</p>
        </div>
    </div>
    <form action="{{ route('snap-bayar') }}" method="post">
        @csrf
        <div class="card w-50 mt-4 mx-auto" >
                <input type="hidden" name="id_pesanan" value="{{ $pesanan->id }}">
                <div class="card-body">
                    @if ($pesanan->paketnya->kategorinya->nama != 'Lain-lain')
                        
                    <div>
                        <div>
                            Pembayaran
                        </div>
                        <div class="d-flex">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="bayar" id="dp" value="dp">
                                <label class="form-check-label" for="dp">
                                DP
                                </label>
                            </div>
                            <div class="form-check mx-3">
                                <input class="form-check-input" type="radio" name="bayar" id="lunas" value="lunas">
                                <label class="form-check-label" for="lunas">
                                Lunas
                                </label>
                            </div>
                        </div>
                        <div>
                            <input type="number" name="nominal" value="1000000" min="1000000" max="{{ $pesanan->paketnya->harga }}" step="500000" class="form-control col-4 d-none">
                        </div>
                    </div>
                    @endif
                    {{-- <div class="mt-2">
                        <div class="mr-auto">Metode Pembayaran</div>
                        <div class="mt-2 d-flex">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="bank" id="bni" value="bni">
                                <label class="form-check-label" for="bni">
                                BNI
                                </label>
                            </div>
                            <div class="form-check mx-3">
                                <input class="form-check-input" type="radio" name="bank" id="bri" value="bri">
                                <label class="form-check-label" for="bri">
                                BRI
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="bank" id="bca" value="bca">
                                <label class="form-check-label" for="bca">
                                BCA
                                </label>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="p-3 ml-auto">
                    <div>
                        Total : Rp{{ number_format($pesanan->paketnya->harga, 0, '', '.') }} <br>
                    </div>
                    <div id="nominal-dp" class="d-none">Dp</div>
                    <div id="sisa-bayar" class="d-none">Sisa</div>
                </div>
                <div class="p-3 ml-auto">
                    <button type="submit" class="btn btn-primary mr-auto">Bayar</button>
                </div>
        </div>
    </form>

<script>
    var bayar = $('input[name=bayar]');
    bayar.on('change', function(){
        var val = $('input[name=bayar]:checked').val();
        if(val == 'dp'){
            $('input[name=nominal]').removeClass('d-none');
            $('input[name=nominal]').val(1000000);
            var nomi = $('input[name=nominal]').val();
            $('#nominal-dp').html('Dp : '+formatRupiah(nomi, "Rp"));
            var harga = parseInt("{{ $pesanan->paketnya->harga }}");
            var dp = parseInt(nomi);
            var sisa = (harga - dp).toString();
            $('#sisa-bayar').html('Sisa : '+formatRupiah(sisa, "Rp"));
            $('#sisa-bayar').removeClass('d-none');
            $('input[name=nominal]').on('change', function(){
                var nominal = $('input[name=nominal]').val();
                $('#nominal-dp').html('Dp : '+formatRupiah(nominal, "Rp"));
                var dp = parseInt(nominal);
                var sisa = (harga - dp).toString();
                $('#sisa-bayar').html('Sisa : '+formatRupiah(sisa, "Rp"));
                $('#sisa-bayar').removeClass('d-none');
            })
            $('#nominal-dp').removeClass('d-none');
        } else {
            $('input[name=nominal]').addClass('d-none');
            $('#nominal-dp').addClass('d-none');
            $('input[name=nominal]').val('');
            $('#sisa-bayar').addClass('d-none');
        }
    })

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>

@endsection