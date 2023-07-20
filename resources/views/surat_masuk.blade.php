@extends('adminlte::page')

@section('title', 'Home Page')

@section('content_header')
    <h1>Data Surat Masuk</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header fs-1">
            {{ __('Pengelolaan Surat Masuk') }}
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
                                <button type="button" id="btn-edit-suratMasuk" class="btn btn-success" data-toggle="modal" data-target="#editSuratMasuk" data-id="{{ $masuk->id }}">Edit</button>
                                <button type="button" id="btn-delete-suratMasuk" class="btn btn-danger" onclick="deleteConfirmation('{{$masuk->id}}','{{$masuk->nama_surat}}')">Hapus</button>
                            </td>
                        </tr>
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
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-users mx-2"></i>Tambah Data Surat Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route ('admin.surat_masuk.submit') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="kode">Kode</label>
                            <input type="text" class="form-control" name="kode" id="kode" required>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editSuratMasuk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Surat Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.surat_masuk.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit-kode">Kode</label>
                                <input type="text" class="form-control" name="kode" id="edit-kode" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-no_surat">No Surat</label>
                                <input type="text" class="form-control" name="no_surat" id="edit-no_surat" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-jenis_dokumens_id">Jenis Dokumen</label>
                                <select name="jenis_dokumens_id" class="form-control" id="edit-jenis_dokumens_id">
                                    <option value="" hidden>-- pilih jenis dokumen --</option>
                                    @foreach($jenis_dokumens as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->jenis_dokumen }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit-nama_surat">No Surat</label>
                                <input type="text" class="form-control" name="nama_surat" id="edit-nama_surat" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-keterangan">No Surat</label>
                                <input type="text" class="form-control" name="keterangan" id="edit-keterangan" required>
                            </div>
                            <div class="form-group" id="file_dokumen_area">
                                <label for="edit-file_surat_masuk">File Surat Masuk</label>
                                <input type="file" class="form-control" name="file_surat_masuk" id="edit-file_surat_masuk">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="edit-id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>

        // MENGAMBIL VALUE DARI SURAT MASUK
        $(function(){
            $(document).on('click','#btn-edit-suratMasuk', function(){
                let id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "{{url('/admin/ajaxadmin/dataSuratMasuk')}}/" + id,
                    datatype: 'json',
                    success: function(res){
                        $('#edit-kode').val(res.kode);
                        $('#edit-no_surat').val(res.no_surat);
                        $('#edit-jenis_dokumens_id').val(res.jenis_dokumens_id);
                        $('#edit-nama_surat').val(res.nama_surat);
                        $('#edit-keterangan').val(res.keterangan);
                        $('#edit-id').val(res.id);

                        if(res.file_surat_masuk !== null) {
                            $('file_surat_masuk_area').append("<img src='"+baseurl+"/storage/file_surat_masuk/"+res.file_dokumen+"' width='200px'>");
                        } else {
                            $('file_surat_masuk_area').append('[File tidak tersedia]');
                        }

                    },
                });
            });
        });

        // FUNCTION DELETE PADA JENIS DOKUMEN
        function deleteConfirmation(npm, nama) {
            swal.fire({
                title: "Hapus",
                type: 'warning',
                text: "Apakah anda yakin akan menghapus data Surat Masuk : " + nama +"?!",
                showCancelButton: !0,
                confirmButtonText: "Ya lakukan",
                cancelButtonText: "Tidak, batalkan!",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "surat_masuks/delete/"+ npm,
                        data: {_token: CSRF_TOKEN},
                        datatype: 'JSON',
                        success: function (results) {
                            if (results.success === true) {
                                swal.fire("Done!", results.message, "success");
                                // REFRESH PAGE AFTER 2
                                setTimeout(function(){
                                    location.reload();
                                },1000);
                            } else {
                                swal.fire("Error!", results.message, "error");
                            }
                        }
                    });
                } else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })
        }
    </script>
@stop