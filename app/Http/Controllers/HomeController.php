<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $countDokumen = Dokumen::count();
        $countSuratMasuk = SuratMasuk::count();
        $countSuratKeluar = SuratKeluar::count();
        $countUser = User::count();

        return view('home', compact('user','countDokumen','countSuratMasuk','countSuratKeluar','countUser'));
    }
}
