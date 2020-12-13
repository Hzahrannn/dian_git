<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Penilaian;
use App\User;

class PenilaianController extends Controller
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
        $data['penilaian'] = penilaian::join('user','penilaian.id_karyawan','=','user.id')->select('penilaian.*', 'user.nama')->get();
        $data['user'] = User::all();
        return view('penilaian', $data);
    }

    public function insert(Request $request)
    {
        $penilaian = new Penilaian;
        $penilaian->id_karyawan = $_POST['id_karyawan'];
        $penilaian->deskripsi = $_POST['deskripsi'];
        $penilaian->nilai = $_POST['nilai'];
        $penilaian->save();

        return redirect('penilaian');
    }
    public function edit($id, Request $request)
    {
        $penilaian =  Penilaian::find($id);
        $penilaian->id_karyawan = $_POST['id_karyawan'];
        $penilaian->deskripsi = $_POST['deskripsi'];
        $penilaian->nilai = $_POST['nilai'];
        $penilaian->save();

        return redirect('penilaian');
    }
    public function delete($id)
    {
        $penilaian =  Penilaian::find($id);
        $penilaian->delete();
        return redirect('penilaian');
    }
}
