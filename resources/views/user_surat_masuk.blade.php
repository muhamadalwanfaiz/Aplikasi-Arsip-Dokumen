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
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahSuratMasuk">
                <i class="fa fa-plus mx-1"></i>Tambah Data
            </button>
            <hr/>
            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>KODE</th>
                        <th>NO SURAT</th>
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
                    @if($user->name == $masuk->username)
                        <tr>
                            <td class="text-center">{{$no++}}</td>
                            <td>{{$masuk->kode}}</td>
                            <td>{{$masuk->no_surat}}</td>
                            <td>{{ \Carbon\Carbon::parse($masuk->created_at)->format('d/m/Y')}}</td>
                            <td>{{$masuk->nama_surat}}</td>
                            <td>{{$masuk->keterangan}}</td>
                            <td class="text-center">
                                <a href="{{ route('pdf.download_surat_masuk', ['id' => $masuk->id]) }}"><button type="button" class="btn btn-success"><i class="fas fa-fw fa-download"></i></button></a>
                            </td>
                        </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="tambahSuratMasuk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-envelope mx-2"></i>Tambah Data Surat Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route ('user.surat_masuk.submit') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="kode">Kode</label>
                            <input type="text" class="form-control" name="kode" id="kode" oninput="updateInput2()" required>
                        </div>
                        <div class="form-group">
                            <label for="no_surat">No Surat</label>
                            <input type="text" class="form-control" name="no_surat" id="no_surat" required>
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
                            <label for="nama_surat">Nama Surat</label>
                            <input type="text" class="form-control" name="nama_surat" id="nama_surat" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan" required>
                        </div>
                        <div class="form-group">
                            <label for="file_surat_masuk">File Surat Masuk</label>
                            <input type="file" class="form-control" name="file_surat_masuk" id="file_surat_masuk" required>
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

@section('js')
    <script>
            function updateInput2() {
            // Mendapatkan nilai dari input pertama
            var input1Value = document.getElementById("kode").value;

            // Menambahkan tanda garis miring (/) pada nilai input pertama dan menyimpannya ke input kedua
            var newValue = input1Value + "/";

            // Menyimpan nilai dari input pertama ke input kedua
            document.getElementById("no_surat").value = newValue;
        }
    </script>
@stop