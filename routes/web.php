<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin/home', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.home')->middleware('is_admin');

//JENIS DOKUMEN

Route::get('admin/jenis_dokumens', [App\Http\Controllers\AdminController::class, 'jenis_dokumens'])->name('admin.jenis_dokumen')->middleware('is_admin');

Route::post('admin/jenis_dokumen', [App\Http\Controllers\AdminController::class, 'submit_jenis_dokumen'])->name('admin.jenis_dokumen.submit')->middleware('is_admin');

Route::patch('admin/jenis_dokumens/update', [App\Http\Controllers\AdminController::class, 'update_jenis_dokumen'])->name('admin.jenis_dokumen.update')->middleware('is_admin');

Route::get('/admin/ajaxadmin/dataJenisDokumen/{id}', [App\Http\Controllers\AdminController::class, 'getDataJenisDokumen']);

Route::post('admin/jenis_dokumens/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete_jenis_dokumen'])->name('admin.jenis_dokumen.delete')->middleware('is_admin');

//DOKUMEN

Route::get('admin/dokumens', [App\Http\Controllers\DokumenController::class, 'dokumens'])->name('admin.dokumen')->middleware('is_admin');

Route::post('admin/dokumen', [App\Http\Controllers\DokumenController::class, 'submit_dokumen'])->name('admin.dokumen.submit')->middleware('is_admin');

Route::patch('admin/dokumens/update', [App\Http\Controllers\DokumenController::class, 'update_dokumen'])->name('admin.dokumen.update')->middleware('is_admin');

Route::get('/admin/ajaxadmin/dataDokumen/{id}', [App\Http\Controllers\DokumenController::class, 'getDataDokumen']);

Route::post('admin/dokumens/delete/{id}', [App\Http\Controllers\DokumenController::class, 'delete_dokumen'])->name('admin.dokumen.delete')->middleware('is_admin');

Route::get('dokumens/view/{id}', [App\Http\Controllers\DokumenController::class, 'view_dokumens'])->name('admin.dokumen.view');

//SURAT MASUK

Route::get('admin/surat_masuks', [App\Http\Controllers\SuratMasukController::class, 'surat_masuks'])->name('admin.surat_masuk')->middleware('is_admin');


//SURAT KELUAR

Route::get('admin/surat_keluars', [App\Http\Controllers\SuratKeluarController::class, 'surat_keluars'])->name('admin.surat_keluar')->middleware('is_admin');

//SEMUA SURAT


Route::get('admin/dokters', [App\Http\Controllers\AdminController::class, 'dokters'])->name('admin.dokters')->middleware('is_admin');


// kelola user

Route::get('admin/kelola_users', [\App\Http\Controllers\AdminController::class, 'user_view'])->name('admin.kelola_users')->middleware('is_admin');

Route::get('admin/kelola_user', [App\Http\Controllers\AdminController::class, 'submit_kelola_user'])->name('admin.kelola_user.submit')->middleware('is_admin');