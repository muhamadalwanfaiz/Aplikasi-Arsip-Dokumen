@extends('adminlte::page')

@section('title', 'Home Page')

@section('content_header')
    <h1>Data User</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header fs-1">
            {{ __('Pengelolaan Dokumen') }}
        </div>
        <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahUserModal">
                <i class="fa fa-plus mx-1"></i>Tambah Data
            </button>
            <hr/>
            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>EMAIL</th>
                        <th>ROLE</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach($view_users as $users)
                        <tr>
                            <td class="text-center">{{$no++}}</td>
                            <td>{{$users->name}}</td>
                            <td>{{$users->email}}</td>
                            <td>{{$users->relationToRole->name}}</td>
                            <td class="text-center">
                                <button type="button" id="btn-edit-user" class="btn btn-warning" data-toggle="modal" data-target="#editUserModal" data-id="{{ $users->id }}"><i class="fas fa-fw fa-edit"></i></button>
                                <button type="button" id="btn-delete-user" class="btn btn-danger" onclick="deleteConfirmation('{{$users->id}}','{{$users->name}}')"><i class="fas fa-fw fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user mx-2"></i>Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route ('admin.kelola_user.submit') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" value="12345" onfocus="handleFocus()" required>
                        </div>
                        <div class="form-group">
                            <label for="roles_id">Role</label>
                            <select name="roles_id" class="form-control" id="roles_id" required>
                                <option value="" hidden>-- pilih role --</option>
                                @foreach($roles as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
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

<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user mx-2"></i>Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route ('admin.kelola_user.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                        <div class="form-group">
                            <label for="edit-name">Nama</label>
                            <input type="text" class="form-control" name="name" id="edit-name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-email">Email</label>
                            <input type="email" class="form-control" name="email" id="edit-email" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-password">Password</label>
                            <input type="password" class="form-control" name="password" id="edit-password" value="12345" onfocus="handleFocus()"  required>
                        </div>
                        <div class="form-group">
                            <label for="edit-roles_id">Role</label>
                            <select name="roles_id" class="form-control" id="edit-roles_id" required>
                                <option value="" hidden>-- pilih role --</option>
                                @foreach($roles as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="edit-id">
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

        // // MENGAMBIL VALUE DARI JENIS DOKUMEN
        $(function(){
            $(document).on('click','#btn-edit-user', function(){
                let id = $(this).data('id');
                $('file_dokumen_area').empty();
                $.ajax({
                    type: "GET",
                    url: "{{url('/admin/ajaxadmin/dataUser')}}/" + id,
                    datatype: 'json',
                    success: function(res){
                        $('#edit-name').val(res.name);
                        $('#edit-email').val(res.email);
                        // $('#edit-password').val(res.password);
                        $('#edit-roles_id').val(res.roles_id);
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });

        // // FUNCTION DELETE PADA JENIS DOKUMEN
        function deleteConfirmation(npm, nama) {
            swal.fire({
                title: "Hapus",
                type: 'warning',
                text: "Apakah anda yakin akan menghapus data User : " + nama +"?!",
                showCancelButton: !0,
                confirmButtonText: "Ya lakukan",
                cancelButtonText: "Tidak, batalkan!",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "kelola_users/delete/"+ npm,
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

        function handleFocus() {
            var passwordInput = $('#edit-password');
            var defaultValue = '12345'; // Ganti dengan nilai default 

            // Jika nilai input sama dengan nilai default, kosongkan input ketika ada fokus (mulai pengisian data)
            if (passwordInput.val() === defaultValue) {
                passwordInput.val('');
            }
        }
    </script>
@stop