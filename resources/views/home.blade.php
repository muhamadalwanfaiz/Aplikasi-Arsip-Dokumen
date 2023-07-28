@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1 class="m-0 text-dark"></h1>
@stop

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-primary">
                    <i class="fas fa-file"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Dokumen</span>
                    <span class="info-box-number">{{ $countDokumen }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success">
                    <i class="far fa-envelope"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Surat Masuk</span>
                    <span class="info-box-number">{{ $countSuratMasuk }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success">
                    <i class="far fa-envelope"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Surat Keluar</span>
                    <span class="info-box-number">{{ $countSuratKeluar }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-warning">
                    <i class="fas fa-user"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">User</span>
                    <span class="info-box-number">{{ $countUser }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Selamat Datang') }}</div>

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
@endsection