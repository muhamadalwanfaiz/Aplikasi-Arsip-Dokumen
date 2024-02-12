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
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahDokumenModal">
                <i class="fa fa-plus mx-1"></i>Tambah Data
            </button>
            <hr/>
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
                    @if($user->name == $dok->username)
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
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="tambahDokumenModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-file mx-2"></i>Tambah Data Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route ('user.dokumen.submit') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="nama_dokumen">Nama Dokumen</label>
                            <input type="text" class="form-control" name="nama_dokumen" id="nama_dokumen" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis_dokumens_id">Jenis Dokumen</label>
                            <select name="jenis_dokumens_id" class="form-control" id="jenis_dokumens_id" required>
                                <option value="" hidden>-- pilih jenis dokumen --</option>
                                @foreach($jenis_dokumens as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->jenis_dokumen }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan" required>
                        </div>
                        <div class="form-group">
                            <label for="file_dokumen">File Dokumen</label>
                            <input type="file" class="form-control" name="file_dokumen" id="file_dokumen" required>
                        </div>
                            <input type="hidden" name="username" id="username" value="{{ $user->name }}" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
