@extends('adminlte::page')

@section('title', 'Home Page')

@section('content_header')
    <h1>View Dokumen</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header fs-1">
            {{ __('Lihat Dokumen') }}
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <table>
                        <tr>
                            <td style="padding-right: 10px;">Nama Dokumen</td>
                            <td style="padding-right: 10px;">:</td>
                            <td>{{ $dok->nama_dokumen }}</td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td>{{ $dok->keterangan }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card-body">
                    <iframe src="{{ asset('storage/file_dokumen/'.$dok->file_dokumen) }}" frameborder="0" width="100%" height="500px">
                    </iframe>
                    {{ asset('/storage/file_dokumen/'.$dok->file_dokumen) }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection