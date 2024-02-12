<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumen;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSuratKeluarController extends Controller
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

        return view('user_surat_keluar',compact('user', 'surat_keluar', 'jenis_dokumens'));
    }

    public function submit_surat_keluar_user(Request $req)
    {
        $validate = $req->validate([
            'kode' => 'required',
            'no_surat' => 'required',
            'nama_surat' => 'required',
            'keterangan' => 'required',
            'jenis_dokumens_id' => 'required',
            'username' => 'required',
        ]);

        $surk = new SuratKeluar();
        $surk->kode = $req->get('kode');
        $surk->no_surat = $req->get('no_surat');
        $surk->jenis_dokumens_id = $req->get('jenis_dokumens_id');
        $surk->nama_surat = $req->get('nama_surat');
        $surk->keterangan = $req->get('keterangan');
        $surk->username = $req->get('username');
        
        if($req->hasFile('file_surat_keluar')) {
            $extension = $req->file('file_surat_keluar')->extension();

            $filename = 'file_surat_keluar_'.time().'.'.$extension;

            $req->file('file_surat_keluar')->storeAs('public/file_surat_keluar', $filename);

            $surk->file_surat_keluar = $filename;
        }

        $surk->save();

        $notification = array(
            'message' => 'Data Surat Keluar Berhasil ditambahkan',
            'alert-type' => 'success'
        );
        return redirect()->route('user.surat_keluar')->with($notification);
    }
}
