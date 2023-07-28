<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\JenisDokumen;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;

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

    public function submit_surat_masuk(Request $req)
    {
        $validate = $req->validate([
            'kode' => 'required',
            'no_surat' => 'required',
            'nama_surat' => 'required',
            'keterangan' => 'required',
            'jenis_dokumens_id' => 'required',
        ]);

        $surm = new SuratMasuk();
        $surm->kode = $req->get('kode');
        $surm->no_surat = $req->get('no_surat');
        $surm->jenis_dokumens_id = $req->get('jenis_dokumens_id');
        $surm->nama_surat = $req->get('nama_surat');
        $surm->keterangan = $req->get('keterangan');
        
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
        return redirect()->route('admin.surat_masuk')->with($notification);
    }

    public function getDataSuratMasuk($id)
    {
        $surm = SuratMasuk::find($id);
        return response()->json($surm);
    }

    public function update_surat_masuk(Request $req) 
    {
        $surm = SuratMasuk::find($req->get('id'));

        $validate = $req->validate([
            'kode' => 'required',
            'no_surat' => 'required',
            'nama_surat' => 'required',
            'keterangan' => 'required',
            'jenis_dokumens_id' => 'required',
        ]);

        $surm->kode = $req->get('kode');
        $surm->no_surat = $req->get('no_surat');
        $surm->jenis_dokumens_id = $req->get('jenis_dokumens_id');
        $surm->nama_surat = $req->get('nama_surat');
        $surm->keterangan = $req->get('keterangan');

        if($req->hasFile('file_surat_masuk')) {
            $extension = $req->file('file_surat_masuk')->extension();

            $filename = 'file_surat_masuk_'.time().'.'.$extension;

            $req->file('file_surat_masuk')->storeAs('public/file_surat_masuk', $filename);

            Storage::delete('public/file_surat_masuk/'.$req->get('old_file_surat_masuk'));

            $surm->file_surat_masuk = $filename;
        }

        $surm->save();
        $notification = array(
            'message' => 'Data Surat Masuk berhasil diubah',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.surat_masuk')->with($notification);
    }

    public function delete_surat_masuk($id)
    {
        $surm = SuratMasuk::find($id);

        $surm->delete();

        $success = true;
        $message = "Data Surat Masuk berhasil dihapus";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function downloadFileSuratMasuk($id)
    {
        $file = SuratMasuk::find($id);
        $filePath = $file->file_surat_masuk;
        $path = storage_path('app/public/file_surat_masuk/' . $filePath);

        if (!Storage::exists('public/file_surat_masuk/' . $filePath)) {
            abort(404);
        }

        return response()->download('storage/file_surat_masuk/' . $filePath);
    }

    public function print_surat_masuk()
    {
        $surat = SuratMasuk::all();

        $pdf = PDF::loadview('print_surat_masuk',['surat' => $surat])-> setPaper ( 'a4' , 'landscape' );;
        return $pdf->download('data_surat_masuk.pdf');
    }

}