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
        $doks = Dokumen::find(5);
        $jenis_dokumens = JenisDokumen::all();

        return view('user_dokumen',compact('user', 'dokumens','doks', 'jenis_dokumens'));
    }

    //ADD DATA DOKUMEN
    public function submit_dokumen_user(Request $req)
    {
        $validate = $req->validate([
            'nama_dokumen' => 'required',
            'jenis_dokumens_id' => 'required',
            'keterangan' => 'required',
            'username' => 'required',
        ]);

        $dok = new Dokumen();
        $dok->nama_dokumen = $req->get('nama_dokumen');
        $dok->jenis_dokumens_id = $req->get('jenis_dokumens_id');
        $dok->keterangan = $req->get('keterangan');
        $dok->username = $req->get('username');
        
        if($req->hasFile('file_dokumen')) {
            $extension = $req->file('file_dokumen')->extension();

            $filename = 'file_dokumen_'.time().'.'.$extension;

            $req->file('file_dokumen')->storeAs('public/file_dokumen', $filename);

            $dok->file_dokumen = $filename;
        }

        $dok->save();

        $notification = array(
            'message' => 'Data Dokumen Berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('user.dokumen')->with($notification);
    }
}
