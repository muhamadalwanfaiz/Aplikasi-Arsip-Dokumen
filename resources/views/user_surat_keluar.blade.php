@extends('adminlte::page')

@section('title', 'Home Page')

@section('content_header')
    <h1>Data Surat Keluar</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header fs-1">
            {{ __('Surat Keluar') }}
        </div>
        <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#">
                <i class="fa fa-plus mx-1"></i>Tambah Data
            </button>
            <hr/>
            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>KODE</th>
                        <th>NO SURAT</th>
                        <th>TANGGAL KELUAR</th>
                        <th>NAMA SURAT</th>
                        <th>KETERANGAN</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach($surat_keluar as $keluar)
                        <tr>
                            <td class="text-center">{{$no++}}</td>
                            <td>{{$keluar->kode}}</td>
                            <td>{{$keluar->no_surat}}</td>
                            <td>{{ \Carbon\Carbon::parse($keluar->created_at)->format('d/m/Y')}}</td>
                            <td>{{$keluar->nama_surat}}</td>
                            <td>{{$keluar->keterangan}}</td>
                            <td class="text-center">
                                <a href="{{ route('pdf.download_surat_keluar', ['id' => $keluar->id]) }}"><button type="button" class="btn btn-success"><i class="fas fa-fw fa-download"></i></button></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
