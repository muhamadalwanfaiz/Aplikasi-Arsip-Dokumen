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
    return view('arsip_home');
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

Route::get('/show-pdf/{id}', [App\Http\Controllers\DokumenController::class, 'showPdf'])->name('admin.show_pdf.view');

Route::get('/open-pdf/{id}', [App\Http\Controllers\DokumenController::class, 'openPdf'])->name('admin.open_pdf.view');


Route::get('/download/{id}',  [App\Http\Controllers\DokumenController::class, 'downloadFile'])->name('pdf.download');


//SURAT MASUK

Route::get('admin/surat_masuks', [App\Http\Controllers\SuratMasukController::class, 'surat_masuks'])->name('admin.surat_masuk')->middleware('is_admin');

Route::post('admin/surat_masuk', [App\Http\Controllers\SuratMasukController::class, 'submit_surat_masuk'])->name('admin.surat_masuk.submit')->middleware('is_admin');

Route::patch('admin/surat_masuk/update', [App\Http\Controllers\SuratMasukController::class, 'update_surat_masuk'])->name('admin.surat_masuk.update')->middleware('is_admin');

Route::get('/admin/ajaxadmin/dataSuratMasuk/{id}', [App\Http\Controllers\SuratMasukController::class, 'getDataSuratMasuk']);

Route::post('admin/surat_masuks/delete/{id}', [App\Http\Controllers\SuratMasukController::class, 'delete_surat_masuk'])->name('admin.surat_masuk.delete')->middleware('is_admin');

//SURAT KELUAR

Route::get('admin/surat_keluars', [App\Http\Controllers\SuratKeluarController::class, 'surat_keluars'])->name('admin.surat_keluar')->middleware('is_admin');

Route::post('admin/surat_keluar', [App\Http\Controllers\SuratKeluarController::class, 'submit_surat_keluar'])->name('admin.surat_keluar.submit')->middleware('is_admin');

Route::patch('admin/surat_keluar/update', [App\Http\Controllers\SuratKeluarController::class, 'update_surat_keluar'])->name('admin.surat_keluar.update')->middleware('is_admin');

Route::get('/admin/ajaxadmin/dataSuratKeluar/{id}', [App\Http\Controllers\SuratKeluarController::class, 'getDataSuratKeluar']);

Route::post('admin/surat_keluars/delete/{id}', [App\Http\Controllers\SuratKeluarController::class, 'delete_surat_keluar'])->name('admin.surat_keluar.delete')->middleware('is_admin');

//SEMUA SURAT


Route::get('admin/dokters', [App\Http\Controllers\AdminController::class, 'dokters'])->name('admin.dokters')->middleware('is_admin');


// kelola user

Route::get('admin/kelola_users', [\App\Http\Controllers\AdminController::class, 'user_view'])->name('admin.kelola_users')->middleware('is_admin');

Route::post('admin/kelola_user', [App\Http\Controllers\AdminController::class, 'submit_user'])->name('admin.kelola_user.submit')->middleware('is_admin');

Route::patch('admin/kelola_user/update', [App\Http\Controllers\AdminController::class, 'update_user'])->name('admin.kelola_user.update')->middleware('is_admin');

Route::get('/admin/ajaxadmin/dataUser/{id}', [App\Http\Controllers\AdminController::class, 'getDataUser']);

Route::post('admin/kelola_users/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete_user'])->name('admin.kelola_user.delete')->middleware('is_admin');