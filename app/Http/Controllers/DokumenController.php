<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\JenisDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
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

        return view('dokumen',compact('user', 'dokumens', 'jenis_dokumens'));
    }

    //ADD DATA DOKUMEN
    public function submit_dokumen(Request $req)
    {
        $validate = $req->validate([
            'nama_dokumen' => 'required',
            'jenis_dokumens_id' => 'required',
            'keterangan' => 'required',
        ]);

        $dok = new Dokumen();
        $dok->nama_dokumen = $req->get('nama_dokumen');
        $dok->jenis_dokumens_id = $req->get('jenis_dokumens_id');
        $dok->keterangan = $req->get('keterangan');
        
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

        return redirect()->route('admin.dokumen')->with($notification);
    }

    //GET DATA DOKUMEN DENGAN AJAX
    public function getDataDokumen($id)
    {
        $dok = Dokumen::find($id);
        return response()->json($dok);
    }

    //UPDATE DATA DOKUMEN

    public function update_dokumen(Request $req) 
    {
        $dok = Dokumen::find($req->get('id'));

        $validate = $req->validate([
            'keterangan' => 'required',
            'jenis_dokumens_id' => 'required',
            'keterangan' => 'required',
        ]);

        $dok->nama_dokumen = $req->get('nama_dokumen');
        $dok->jenis_dokumens_id = $req->get('jenis_dokumens_id');
        $dok->keterangan = $req->get('keterangan');

        if($req->hasFile('file_dokumen')) {
            $extension = $req->file('file_dokumen')->extension();

            $filename = 'file_dokumen_'.time().'.'.$extension;

            $req->file('file_dokumen')->storeAs('public/file_dokumen', $filename);

            Storage::delete('public/file_dokumen/'.$req->get('old_file_dokumen'));

            $dok->file_dokumen = $filename;
        }

        $dok->save();
        $notification = array(
            'message' => 'Data Dokumen berhasil diubah',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.dokumen')->with($notification);
    }

    //HAPUS DATA DOKUMEN
    public function delete_dokumen($id)
    {
        $dok = Dokumen::find($id);

        $dok->delete();

        $success = true;
        $message = "Data Dokumen berhasil dihapus";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function view_dokumens($id)
    {
        $dok = Dokumen::find($id);
        $doks = basename(public_path('/storage/file_dokumen/'.$dok->file_dokumen));

        return view('view_dokumen', compact('dok','doks'));
    }
}
