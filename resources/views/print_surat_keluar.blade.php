<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <p class="text-center font-weight-bold" style="font-size: 27px; margin: 0px;">NOMOR SURAT</p>
    <p class="text-center font-weight-bold" style="font-size: 27px; margin: 0px;">SDN CINTANAGARA</p>
    <br/>
    <table id="table-data" class="table table-bordered">
        <thead>
            <tr class="bg-warning text-center font-weight-bold">
                <td>NO</td>
                <td>KODE</td>
                <td>NO SURAT</td>
                <td>TANGGAL KELUAR</td>
                <td>NAMA SURAT</td>
                <td>KETERANGAN</td>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach($surat as $sk)
                <tr>
                    <td class="table-light">{{ $no++ }}</td>
                    <td class="table-light">{{ $sk->kode }}</td>
                    <td class="table-light">{{ $sk->no_surat }}</td>
                    <td class="table-light">{{ \Carbon\Carbon::parse($sk->created_at)->format('d-m-Y')}}</td>
                    <td class="table-light">{{ $sk->nama_surat }}</td>
                    <td class="table-light">{{ $sk->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>