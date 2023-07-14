<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumen;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratKeluarController extends Controller
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
    public function surat_keluars()
    {
        $user = Auth::user();
        $surat_keluar = SuratKeluar::all();
        $jenis_dokumens = JenisDokumen::all();

        return view('surat_keluar',compact('user', 'surat_keluar', 'jenis_dokumens'));
    }
}
