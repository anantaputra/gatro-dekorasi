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
        <h2>Laporan Data Penyewaan</h2>
    </div>
    <table class="table">
        <thead>
          <tr>
            <th class="align-middle">No</th>
            <th class="align-middle">Nama Customer</th>
            <th class="align-middle">Nama Paket</th>
            <th class="align-middle">Harga Paket</th>
            <th class="align-middle">Tanggal Acara</th>
            <th class="align-middle">Lokasi Acara</th>
            <th class="align-middle">Sudah Bayar</th>
          </tr>
        </thead>
        <tbody>
          @php
              $no = 1;
          @endphp
          @foreach ($penyewaan as $item)
          <tr>
            <td>{{ $no }}</td>
            <td>{{ $item->usernya->name }}</td>
            <td>{{ $item->paketnya->nama }}</td>
            <td>Rp{{ number_format($item->paketnya->harga, 0, '', '.') }}</td>
            <td>{{ date("d/m/Y", strtotime($item->tgl_acara)) }}</td>
            <td>{{ $item->alamat_acara }}</td>
            <td>
              @php
                $status = App\Http\Controllers\Admin\AdminPengembalianController::cekStatus($item->id)
              @endphp
              @if ($status != 'Selesai')
              Rp1.000.000
              @else
              Rp{{ number_format($item->paketnya->harga, 0, '', '.') }}
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