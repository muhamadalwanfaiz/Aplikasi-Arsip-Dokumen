@extends('adminlte::page')

@section('title', 'Home Page')

@section('content_header')
    <h1>Data Surat Keluar</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header fs-1">
            {{ __('Pengelolaan Surat Keluar') }}
        </div>
        <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahJenisDokModal">
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
                            <td>{{$keluar->created_at}}</td>
                            <td>{{$keluar->nama_surat}}</td>
                            <td>{{$keluar->keterangan}}</td>
                            <td class="text-center">
                                <button type="button" id="btn-edit-jenisDok" class="btn btn-success" data-toggle="modal" data-target="#editJenisDokModal" data-id="{{ $keluar->id }}">Edit</button>
                                <button type="button" id="btn-delete-jenisDok" class="btn btn-danger" onclick="deleteConfirmation('{{$keluar->id}}','{{$keluar->no_surat}}')">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- <div class="modal fade" id="tambahJenisDokModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-users mx-2"></i>Tambah Data Jenis Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route ('admin.jenis_dokumen.submit') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="jenis_dokumen">Jenis Dokumen</label>
                            <input type="text" class="form-control" name="jenis_dokumen" id="jenis_dokumen" required>
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

<div class="modal fade" id="editJenisDokModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.jenis_dokumen.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit-jenis_dokumen">Jenis Dokumen</label>
                                <input type="text" class="form-control" name="jenis_dokumen" id="edit-jenis_dokumen" required>
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
</div> --}}
@endsection

@section('js')
    <script>

    //     // MENGAMBIL VALUE DARI JENIS DOKUMEN
    //     $(function(){
    //         $(document).on('click','#btn-edit-jenisDok', function(){
    //             let id = $(this).data('id');
    //             $.ajax({
    //                 type: "GET",
    //                 url: "{{url('/admin/ajaxadmin/dataJenisDokumen')}}/" + id,
    //                 datatype: 'json',
    //                 success: function(res){
    //                     $('#edit-jenis_dokumen').val(res.jenis_dokumen);
    //                     $('#edit-id').val(res.id);
    //                 },
    //             });
    //         });
    //     });

    //     // FUNCTION DELETE PADA JENIS DOKUMEN
    //     function deleteConfirmation(npm, nama) {
    //         swal.fire({
    //             title: "Hapus",
    //             type: 'warning',
    //             text: "Apakah anda yakin akan menghapus data Jenis Dokumen : " + nama +"?!",
    //             showCancelButton: !0,
    //             confirmButtonText: "Ya lakukan",
    //             cancelButtonText: "Tidak, batalkan!",
    //             reverseButtons: !0
    //         }).then(function (e) {
    //             if (e.value === true) {
    //                 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    //                 $.ajax({
    //                     type: 'POST',
    //                     url: "jenis_dokumens/delete/"+ npm,
    //                     data: {_token: CSRF_TOKEN},
    //                     datatype: 'JSON',
    //                     success: function (results) {
    //                         if (results.success === true) {
    //                             swal.fire("Done!", results.message, "success");
    //                             // REFRESH PAGE AFTER 2
    //                             setTimeout(function(){
    //                                 location.reload();
    //                             },1000);
    //                         } else {
    //                             swal.fire("Error!", results.message, "error");
    //                         }
    //                     }
    //                 });
    //             } else {
    //                 e.dismiss;
    //             }
    //         }, function (dismiss) {
    //             return false;
    //         })
    //     }
    </script>
@stop