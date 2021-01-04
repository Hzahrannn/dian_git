<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Mutasi;
use App\User;

class MutasiController extends Controller
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
        if (Auth::user()->jabatan != 'karyawan') {
            $data['mutasi'] = Mutasi::join('user','mutasi.id_karyawan','=','user.id')->select('mutasi.*', 'user.nama')->get();
        }else{
            $data['mutasi'] = Mutasi::join('user','mutasi.id_karyawan','=','user.id')->select('mutasi.*', 'user.nama')->where('mutasi.id_karyawan',Auth::user()->id)->get();
        }
        $data['user'] = User::where('jabatan','karyawan')->get();
        return view('mutasi', $data);
    }

    public function insert(Request $request)
    {
        if ($files = $request->file('foto_surat_mutasi')) {
            $name = $files->getClientOriginalName();
            $files->move('image_surat_mutasi', $name);
        }
        $mutasi = new Mutasi;
        $mutasi->id_karyawan = $_POST['id_karyawan'];
        $mutasi->surat_mutasi = $name;
        $mutasi->keputusan = $_POST['keputusan'];
        $mutasi->save();

        return redirect('mutasi');
    }
    public function edit($id, Request $request)
    {
        if ($files = $request->file('foto_surat_mutasi')) {
            $name = $files->getClientOriginalName();
            $files->move('image_surat_mutasi', $name);
        }
        $mutasi =  Mutasi::find($id);
        $mutasi->id_karyawan = $_POST['id_karyawan'];
        $mutasi->surat_mutasi = $name;
        $mutasi->keputusan = $_POST['keputusan'];
        $mutasi->save();

        return redirect('mutasi');
    }
    public function delete($id)
    {
        $mutasi =  Mutasi::find($id);
        $mutasi->delete();
        return redirect('mutasi');
    }
}
