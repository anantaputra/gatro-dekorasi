@extends('layouts.detail')

@section('content')

@if (Session::has('booked'))
    <script>
        alert('{{ session("booked") }}')
    </script>
@endif

    <div class="container">
        <div class="mt-3 w-100">
            @if (isset($sewa))
            <form action="{{ route('user.sewa.simpan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <h4 class="text-center" style="color: #ab7661; font-family: 'Times New Roman', Times, serif">Formulir Penyewaan</h4><br>
                    <label for="exampleFormControlInput1" style="font-family: 'Times New Roman', Times, serif">Nama</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->nama }}" name="nama" id="exampleFormControlInput1" placeholder="nama" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1" style="font-family: 'Times New Roman', Times, serif">Lokasi Acara</label>
                        <select class="form-control" name="lokasi" id="exampleFormControlSelect1">
                            <option selected disabled>pilih lokasi</option>
                            <option value="Gedung">Gedung</option>
                            <option value="Rumah">Rumah</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="" style="font-family: 'Times New Roman', Times, serif">Alamat Lokasi Acara</label>
                    <textarea class="form-control" id="alamat_acara" name="alamat_acara" rows="3" placeholder="Alamat lokasi acara"></textarea>
                </div>
                <div class="form-group">
                    <label for="" style="font-family: 'Times New Roman', Times, serif">Tanggal Acara</label>
                    <input type="date" class="form-control" id="tgl_acara" name="tgl_acara" placeholder="dd/mm/yy">
                </div>
                <div class="form-group">
                    <label for="" style="font-family: 'Times New Roman', Times, serif">Tanggal Pengembalian</label>
                    <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" placeholder="dd/mm/yy">
                </div>
                <div class="form-group">
                    <label for="" style="font-family: 'Times New Roman', Times, serif">Nama Paket</label>
                    <select class="custom-select" disabled id="inputGroupSelect02">
                        <option value="{{ $sewa->id }}" selected>{{ $sewa->nama }}</option>
                    </select>
                    <input type="hidden" name="nama_paket" value="{{ $sewa->id }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1" style="font-family: 'Times New Roman', Times, serif">Catatan</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1"  name="catatan" rows="3"></textarea>
                </div>
                <button type="submit" class="btn" style="background-color: #c88a72; color:white">Kirim</button>
            </form>
            @endif
        </div>
    </div>

<script>
    $(function(){
        var dtToday = new Date(); // buat variabel dtToday yg isinya memanggil fungsi new Date js
        var month = dtToday.getMonth() + 1; // mengambil data bulan ini dengan fungsi getMonth() namun harus ditambah 1 karena hasil dari getMonth() dimulai dari 0 sedangkan bulan kita dimulai dari 1
        var day = dtToday.getDate() + 1; // mengambil data tgl hari ini
        var year = dtToday.getFullYear(); // mengambil data tahun hari ini
        if(month < 10) // jika bulan yg didapatkan kurang dari 10
            month = '0' + month.toString(); // tambahkan 0 didepan angkanya
        if(day < 10) // jika tgl yg didapatkan kurang dari 10
            day = '0' + day.toString(); // tambahkan 0 didepan angkanya
        
        var maxDate = year + '-' + month + '-' + day; // buat variabel maxDate dengan format YYYY-mm-dd
        $('#tgl_acara').attr('min', maxDate); // tambahkan atribut min pada element dg id tgl_acara
        $('#tgl_acara').on('change', function(){ // ketika element dg id tgl_acara berubah jalankan fungsi dibawah ini
            const acara =  $('#tgl_acara').val(); // buat variabel acara = value atau nilai dari element dg id tgl_acara
            // console.log(acara);
            $('#tgl_kembali').attr('min', acara); // tambahkan atribut min pada element dg id tgl_kembali
            var acaraDay = new Date(acara);
            var monthAcara = acaraDay.getMonth() + 1;
            var dayAcara = acaraDay.getDate() + 2; // mengambil data tgl hari ini + 2 atau 2 hari kedepan
            var yearAcara = acaraDay.getFullYear();
            if(monthAcara < 10)
                monthAcara = '0' + monthAcara.toString();
            if(dayAcara < 10)
                dayAcara = '0' + dayAcara.toString();
            var jml = new Date(yearAcara, monthAcara, 0).getDate(); // dapatkan jml hari dlm 1 bulan ini
            if(dayAcara > jml){ // jika tgl acara lebih besar dari jml hari dlm 1 bulan ini 
                dayAcara = dayAcara - jml; // tgl acara = tgl acara - jml hari dlm 1 bulan atau dlm kata lain ini akan mendapatkan hari2 awal bulan
                monthAcara = acaraDay.getMonth() + 2; // dapatkan bulan depan makanya +2 karena kalo +1 itu bulan saat ini
                if(monthAcara < 10)
                    monthAcara = '0' + monthAcara.toString();
                if(dayAcara < 10)
                    dayAcara = '0' + dayAcara.toString();
            }
            var maxDateKembali = (yearAcara + '-' + monthAcara + '-' +dayAcara) // buat variabel maxDateKembali atau batas maksimal pengembalian
            // console.log(maxDateKembali)
            $('#tgl_kembali').attr('max', maxDateKembali); // set atrribut max pada element id tgl_kembali jadi ini akan membatasi tanggal agar tidak melebihi tgl maxDateKembali atau dlm kata lain membuat tgl lain menjadi tidak dapat diakses atau dipilih
        })
    });
</script>

@endsection
