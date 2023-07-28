@extends('adminlte::page')

@section('title', 'Home Page')

@section('content_header')
    <h1>Data Dokumen</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header fs-1">
            {{ __('Dokumen') }}
        </div>
        <div class="card-body">
            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>NAMA DOKUMEN</th>
                        <th>JENIS DOKUMEN</th>
                        <th>TANGGAL</th>
                        <th>KETERANGAN</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach($dokumens as $dok)
                        <tr>
                            <td class="text-center">{{$no++}}</td>
                            <td>{{$dok->nama_dokumen}}</td>
                            <td>{{$dok->relationToJenisDokumen->jenis_dokumen}}</td>
                            <td>{{ \Carbon\Carbon::parse($dok->created_at)->format('d/m/Y')}}</td>
                            <td>{{$dok->keterangan}}</td>
                            <td class="text-center">
                                <a href="{{ route('pdf.download_dokumen', ['id' => $dok->id]) }}"><button type="button" class="btn btn-success"><i class="fas fa-fw fa-download"></i></button></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
