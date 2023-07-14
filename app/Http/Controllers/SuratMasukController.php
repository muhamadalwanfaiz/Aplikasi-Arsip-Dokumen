<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\JenisDokumen;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('home', compact('user'));
    }

    //VIEW DATA DOKUMEN
    public function surat_masuks()
    {
        $user = Auth::user();
        $surat_masuk = SuratMasuk::all();
        $jenis_dokumens = JenisDokumen::all();

        return view('surat_masuk',compact('user', 'surat_masuk', 'jenis_dokumens'));
    }
}
