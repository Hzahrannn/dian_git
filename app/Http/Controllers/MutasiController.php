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
         $data['mutasi'] = Mutasi::join('user','mutasi.id_karyawan','=','user.id')->select('mutasi.*', 'user.nama')->get();
        $data['user'] = User::all();
        return view('mutasi', $data);
    }

    public function insert(Request $request)
    {
        $mutasi = new Mutasi;
        $mutasi->id_karyawan = $_POST['id_karyawan'];
        $mutasi->tanggal = $_POST['tanggal'];
        $mutasi->lokasi = $_POST['lokasi'];
        $mutasi->save();

        return redirect('mutasi');
    }
    public function edit($id, Request $request)
    {
        $mutasi =  Mutasi::find($id);
        $mutasi->id_karyawan = $_POST['id_karyawan'];
        $mutasi->tanggal = $_POST['tanggal'];
        $mutasi->lokasi = $_POST['lokasi'];
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
