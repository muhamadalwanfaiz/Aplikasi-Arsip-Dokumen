@extends('adminlte::page')

@section('title', 'Home Page')

@section('content_header')
    <h1>Data Surat Masuk</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header fs-1">
            {{ __('Surat Masuk') }}
        </div>
        <div class="card-body">
            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>KODE</th>
                        <th>NO SURAT</th>
                        <th>JENIS SURAT</th>
                        <th>TANGGAL MASUK</th>
                        <th>NAMA SURAT</th>
                        <th>KETERANGAN</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach($surat_masuk as $masuk)
                        <tr>
                            <td class="text-center">{{$no++}}</td>
                            <td>{{$masuk->kode}}</td>
                            <td>{{$masuk->no_surat}}</td>
                            <td>{{$masuk->jenis_dokumens_id}}</td>
                            <td>{{ \Carbon\Carbon::parse($masuk->created_at)->format('d/m/Y')}}</td>
                            <td>{{$masuk->nama_surat}}</td>
                            <td>{{$masuk->keterangan}}</td>
                            <td class="text-center">
                                <a href="{{ route('pdf.download_surat_masuk', ['id' => $masuk->id]) }}"><button type="button" class="btn btn-success"><i class="fas fa-fw fa-download"></i></button></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection