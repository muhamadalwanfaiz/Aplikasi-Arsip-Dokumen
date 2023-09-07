<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Dokumen;
use App\Models\JenisDokumen;
use App\Models\User;
use App\Models\Role;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        $countDokumen = Dokumen::count();
        $countSuratMasuk = SuratMasuk::count();
        $countSuratKeluar = SuratKeluar::count();
        $countUser = User::count();

        return view('home', compact('user','countDokumen','countSuratMasuk','countSuratKeluar','countUser'));
    }

    // VIEW DATA PASIEN
    public function jenis_dokumens()
    {
        $user = Auth::user();
        $jenis_dokumens = JenisDokumen::all();

        return view('jenis_dokumen',compact('user', 'jenis_dokumens'));
    }

    // ADD DATA PASIEN
    public function submit_jenis_dokumen(Request $req)
    {
        $validate = $req->validate([
            'jenis_dokumen' => 'required',
        ]);

        $jenis_dok = new JenisDokumen();
        $jenis_dok->jenis_dokumen = $req->get('jenis_dokumen');

        $jenis_dok->save();
        $notification = array(
            'message' => 'Data Kategori berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.jenis_dokumen')->with($notification);
    }

    // AJAX PROCESS
    public function getDataJenisDokumen($id)
    {
        $Jenis_dokumen = JenisDokumen::find($id);
        return response()->json($Jenis_dokumen);
    }

    // UPADATE DATA PASIEN
    public function update_jenis_dokumen(Request $req) 
    {
        $jenis_dok = JenisDokumen::find($req->get('id'));

        $validate = $req->validate([
            'jenis_dokumen' => 'required',
        ]);

        $jenis_dok->jenis_dokumen = $req->get('jenis_dokumen');

        $jenis_dok->save();

        $notification = array(
            'message' => 'Data Kategori berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.jenis_dokumen')->with($notification);

    }

    // DELETE DATA PASIEN
    public function delete_jenis_dokumen($id)
    {
        $jenis_dok = JenisDokumen::find($id);

        $jenis_dok->delete();

        $success = true;
        $message = "Data Kategori berhasil dihapus";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }




    /////////////////////////////////////////////////
    //kelola User

    public function user_view()
    {
        $view_users = User::all();
        $roles = Role::all();
        return view('kelola_user', compact('view_users','roles'));
    }

    public function submit_user(Request $req)
    {
        $validate = $req->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'roles_id' => 'required',
        ]);

        $users = new User();
        $users->name = $req->get('name');
        $users->email = $req->get('email');
        $users->password = Hash::make($req->get('password'));
        $users->roles_id = $req->get('roles_id');

        $users->save();
        $notification = array(
            'message' => 'Data User berhasil ditambahkan',
            'alert-type' => 'success'
        );
        

        return redirect()->route('admin.kelola_users')->with($notification);
    }

    public function getDataUser($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function update_user(Request $req) 
    {
        $users = User::find($req->get('id'));

        $validate = $req->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'roles_id' => 'required',
        ]);

        $users->name = $req->get('name');
        $users->email = $req->get('email');
        $users->password = Hash::make($req->get('password'));
        $users->roles_id = $req->get('roles_id');

        $users->save();

        $notification = array(
            'message' => 'Data User berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.kelola_users')->with($notification);

    }

    public function delete_user($id)
    {
        $user = User::find($id);

        $user->delete();

        $success = true;
        $message = "Data User berhasil dihapus";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
