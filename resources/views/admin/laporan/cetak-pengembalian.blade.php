<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Gatro Dekorasi</title>
</head>
<body>
    <div class="d-flex justify-content-center my-3">
        <h2>Laporan Pengembalian</h2>
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
        <tbody>
            @php
            $no = 1;
        @endphp
        @foreach ($pengembalian as $item)
        <tr>
          <td>{{ $no }}</td>
          <td>{{ $item->pesanannya->usernya->name }}</td>
          <td>{{ $item->pesanannya->paketnya->nama }}</td>
          <td>Rp{{ number_format($item->pesanannya->paketnya->harga, 0, '', '.') }}</td>
          <td>{{ date("d/m/Y", strtotime($item->pesanannya->tgl_acara)) }}</td>
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
        </tbody>
    </table>     

    <script>
        window.print()
    </script>
</body>
</html>