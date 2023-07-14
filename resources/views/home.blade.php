@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Dokumen</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-right">000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Surat</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-right">000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dasboard') }}</div>

                <div class="card-body">
                    @if ($user->roles_id == 1)
                        Anda Login Sebagai Admin
                    @else
                        Anda Login Sebagai User
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <p>Id dari user yang sedang login ( {{$user->roles_id}} )</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dokumen') }}</div>
                <div class="card-body">
                    <table class="table tabel-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA DOKUMEN</th>
                                <th>JENIS DOKUMEN</th>
                                <th>TANGGAL</th>
                                <th>KETARANGAN</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
