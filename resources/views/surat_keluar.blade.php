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
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahSuratKeluar">
                <i class="fa fa-plus mx-1"></i>Tambah Data
            </button>
            <a href="{{ route('admin.surat_keluar.print') }}" target="_blank"><button class="btn btn-secondary"><i class="fa fa-print mx-1"></i>Cetak PDF</button></a>
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
                            <td>{{ \Carbon\Carbon::parse($keluar->created_at)->format('d-m-Y')}}</td>
                            <td>{{$keluar->nama_surat}}</td>
                            <td>{{$keluar->keterangan}}</td>
                            <td class="text-center">
                                <a href="{{ route('pdf.download_surat_keluar', ['id' => $keluar->id]) }}"><button type="button" class="btn btn-success"><i class="fas fa-fw fa-download"></i></button></a>
                                <button type="button" id="btn-edit-suratKeluar" class="btn btn-warning" data-toggle="modal" data-target="#editSuratKeluar" data-id="{{ $keluar->id }}"><i class="fas fa-fw fa-edit"></i></button>
                                <button type="button" id="btn-delete-suratKeluar" class="btn btn-danger" onclick="deleteConfirmation('{{$keluar->id}}','{{$keluar->nama_surat}}')"><i class="fas fa-fw fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahSuratKeluar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-envelope mx-2"></i>Tambah Data Surat Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route ('admin.surat_keluar.submit') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="text" class="form-control" name="kode" id="kode"  oninput="updateInput2()" required>
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
                        <label for="file_surat_keluar">File Surat Masuk</label>
                        <input type="file" class="form-control" name="file_surat_keluar" id="file_surat_keluar" required>
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

<div class="modal fade" id="editSuratKeluar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Surat Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.surat_keluar.update') }}" enctype="multipart/form-data">
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
                                <label for="edit-file_surat_keluar">File Surat Masuk</label>
                                <input type="file" class="form-control" name="file_surat_keluar" id="edit-file_surat_keluar">
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

    //     // MENGAMBIL VALUE DARI JENIS DOKUMEN
        $(document).on('click','#btn-edit-suratKeluar', function(){
                let id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "{{url('/admin/ajaxadmin/dataSuratKeluar')}}/" + id,
                    datatype: 'json',
                    success: function(res){
                        $('#edit-kode').val(res.kode);
                        $('#edit-no_surat').val(res.no_surat);
                        $('#edit-jenis_dokumens_id').val(res.jenis_dokumens_id);
                        $('#edit-nama_surat').val(res.nama_surat);
                        $('#edit-keterangan').val(res.keterangan);
                        $('#edit-id').val(res.id);

                        if(res.file_surat_keluar !== null) {
                            $('file_surat_keluar_area').append("<img src='"+baseurl+"/storage/file_surat_keluar/"+res.file_surat_keluar+"' width='200px'>");
                        } else {
                            $('file_surat_keluar_area').append('[File tidak tersedia]');
                        }

                    },
                });
            });

        // FUNCTION DELETE PADA JENIS DOKUMEN
        function deleteConfirmation(npm, nama) {
            swal.fire({
                title: "Hapus",
                type: 'warning',
                text: "Apakah anda yakin akan menghapus data Surat Keluar : " + nama +"?!",
                showCancelButton: !0,
                confirmButtonText: "Ya lakukan",
                cancelButtonText: "Tidak, batalkan!",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "surat_keluars/delete/"+ npm,
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