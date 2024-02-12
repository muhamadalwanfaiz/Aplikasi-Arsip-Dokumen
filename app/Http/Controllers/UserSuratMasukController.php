<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumen;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSuratMasukController extends Controller
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

        return view('user_surat_masuk',compact('user', 'surat_masuk', 'jenis_dokumens'));
    }


    public function submit_surat_masuk_user(Request $req)
    {
        $validate = $req->validate([
            'kode' => 'required',
            'no_surat' => 'required',
            'nama_surat' => 'required',
            'keterangan' => 'required',
            'jenis_dokumens_id' => 'required',
            'username' => 'required',
        ]);

        $surm = new SuratMasuk();
        $surm->kode = $req->get('kode');
        $surm->no_surat = $req->get('no_surat');
        $surm->jenis_dokumens_id = $req->get('jenis_dokumens_id');
        $surm->nama_surat = $req->get('nama_surat');
        $surm->keterangan = $req->get('keterangan');
        $surm->username = $req->get('username');
        
        if($req->hasFile('file_surat_masuk')) {
            $extension = $req->file('file_surat_masuk')->extension();

            $filename = 'file_surat_masuk_'.time().'.'.$extension;

            $req->file('file_surat_masuk')->storeAs('public/file_surat_masuk', $filename);

            $surm->file_surat_masuk = $filename;
        }

        $surm->save();

        $notification = array(
            'message' => 'Data Surat Masuk Berhasil ditambahkan',
            'alert-type' => 'success'
        );
        return redirect()->route('user.surat_masuk')->with($notification);
    }
}
