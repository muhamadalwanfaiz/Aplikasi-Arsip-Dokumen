<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumen;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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

    public function submit_surat_keluar(Request $req)
    {
        $validate = $req->validate([
            'kode' => 'required',
            'no_surat' => 'required',
            'nama_surat' => 'required',
            'keterangan' => 'required',
            'jenis_dokumens_id' => 'required',
        ]);

        $surk = new SuratKeluar();
        $surk->kode = $req->get('kode');
        $surk->no_surat = $req->get('no_surat');
        $surk->jenis_dokumens_id = $req->get('jenis_dokumens_id');
        $surk->nama_surat = $req->get('nama_surat');
        $surk->keterangan = $req->get('keterangan');
        
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
        return redirect()->route('admin.surat_keluar')->with($notification);
    }

    public function getDataSuratKeluar($id)
    {
        $surk = SuratKeluar::find($id);
        return response()->json($surk);
    }

    public function update_surat_keluar(Request $req) 
    {
        $surk = SuratKeluar::find($req->get('id'));

        $validate = $req->validate([
            'kode' => 'required',
            'no_surat' => 'required',
            'nama_surat' => 'required',
            'keterangan' => 'required',
            'jenis_dokumens_id' => 'required',
        ]);

        $surk->kode = $req->get('kode');
        $surk->no_surat = $req->get('no_surat');
        $surk->jenis_dokumens_id = $req->get('jenis_dokumens_id');
        $surk->nama_surat = $req->get('nama_surat');
        $surk->keterangan = $req->get('keterangan');

        if($req->hasFile('file_surat_keluar')) {
            $extension = $req->file('file_surat_keluar')->extension();

            $filename = 'file_surat_keluar_'.time().'.'.$extension;

            $req->file('file_surat_keluar')->storeAs('public/file_surat_keluar', $filename);

            Storage::delete('public/file_surat_keluar/'.$req->get('old_file_surat_keluar'));

            $surk->file_surat_keluar = $filename;
        }

        $surk->save();
        $notification = array(
            'message' => 'Data Surat Masuk berhasil diubah',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.surat_keluar')->with($notification);
    }

    public function delete_surat_keluar($id)
    {
        $surk = SuratKeluar::find($id);

        $surk->delete();

        $success = true;
        $message = "Data Surat Keluar berhasil dihapus";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function downloadFile($id)
    {
        $file = SuratKeluar::find($id);
        $filePath = $file->file_surat_keluar;
        $path = storage_path('app/public/file_surat_keluar/' . $filePath);

        if (!Storage::exists('public/file_surat_keluar/' . $filePath)) {
            abort(404);
        }

        return response()->download('storage/file_surat_keluar/' . $filePath);

        $notification = array(
            'message' => 'Data Dokumen berhasil diunduh',
            'alert-type' => 'success',
        );
        return redirect()->route('admin.surat_keluar')->with($notification);
    }
}
