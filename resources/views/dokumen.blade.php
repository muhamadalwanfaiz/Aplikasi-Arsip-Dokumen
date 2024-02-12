@extends('adminlte::page')

@section('title', 'Home Page')

@section('content_header')
    <h1>Data Dokumen</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header fs-1">
            {{ __('Pengelolaan Dokumen') }}
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
                        <th>USER</th>
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
                            <td>{{$dok->username}}</td>
                            <td class="text-center">
                                <a href="{{ route('pdf.download_dokumen', ['id' => $dok->id]) }}"><button type="button" class="btn btn-success"><i class="fas fa-fw fa-download"></i></button></a>
                                <button type="button" id="btn-edit-dokumen" class="btn btn-warning" data-toggle="modal" data-target="#editDokModal" data-id="{{ $dok->id }}"><i class="fas fa-fw fa-edit"></i></button>
                                <button type="button" id="btn-delete-dokumen" class="btn btn-danger" onclick="deleteConfirmation('{{$dok->id}}','{{$dok->nama_dokumen}}')"><i class="fas fa-fw fa-trash"></i></button>
                            </td>
                        </tr>
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
                <form method="post" action="{{ route ('admin.dokumen.submit') }}" enctype="multipart/form-data">
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

<div class="modal fade" id="editDokModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.dokumen.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit-nama_dokumen">Nama Dokumen</label>
                                <input type="text" class="form-control" name="nama_dokumen" id="edit-nama_dokumen" required>
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
                                <label for="edit-keterangan">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" id="edit-keterangan" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-old_file_dokumen">Nama File Dokumen</label>
                                <input type="hidden" class="form-control" name="file_dokumen" id="edit-old_file_dokumen" readonly>
                            </div>
                            <div class="form-group" id="file_dokumen_area">
                                <label for="edit-file_dokumen">Unggah File Dokumen Baru</label>
                                <input type="file" class="form-control" name="file_dokumen" id="edit-file_dokumen">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="edit-id">
                        <input type="hidden" name="old_file_dokumen" id="edit-old_file_dokumen">
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

        // MENGAMBIL VALUE DARI JENIS DOKUMEN
        $(function(){
            $(document).on('click','#btn-edit-dokumen', function(){
                let id = $(this).data('id');
                $('file_dokumen_area').empty();
                $.ajax({
                    type: "GET",
                    url: "{{url('/admin/ajaxadmin/dataDokumen')}}/" + id,
                    datatype: 'json',
                    success: function(res){
                        $('#edit-nama_dokumen').val(res.nama_dokumen);
                        $('#edit-keterangan').val(res.keterangan);
                        $('#edit-jenis_dokumens_id').val(res.jenis_dokumens_id);
                        $('#edit-old_file_dokumen').val(res.file_dokumen);
                        $('#edit-id').val(res.id);

                        if(res.file_dokumen !== null) {
                            $('file_dokumen_area').append("<img src='"+baseurl+"storage/file_dokumen/"+res.file_dokumen+"' width='200px'>");
                        } else {
                            $('file_dokumen_area').append('[File tidak tersedia]');
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
                text: "Apakah anda yakin akan menghapus data Dokumen : " + nama +"?!",
                showCancelButton: !0,
                confirmButtonText: "Ya lakukan",
                cancelButtonText: "Tidak, batalkan!",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "dokumens/delete/"+ npm,
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