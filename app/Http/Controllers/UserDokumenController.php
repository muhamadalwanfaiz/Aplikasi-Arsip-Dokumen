<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\JenisDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDokumenController extends Controller
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
    public function dokumens()
    {
        $user = Auth::user();
        $dokumens = Dokumen::all();
        $jenis_dokumens = JenisDokumen::all();

        return view('user_dokumen',compact('user', 'dokumens', 'jenis_dokumens'));
    }
}
