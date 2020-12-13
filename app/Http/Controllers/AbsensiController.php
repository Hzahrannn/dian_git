<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Absensi;
use App\User;

class AbsensiController extends Controller
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
        $data['absensi'] = Absensi::join('user','absensi.id_karyawan','=','user.id')->select('absensi.*', 'user.nama')->get();
        $data['user'] = User::all();
        return view('absensi', $data);
    }

    public function insert(Request $request)
    {
        $absensi = new Absensi;
        $absensi->id_karyawan = $_POST['id_karyawan'];
        $absensi->jam = $_POST['jam'];
        $absensi->save();

        return redirect('absensi');
    }
    public function edit($id, Request $request)
    {
        $absensi =  Absensi::find($id);
        $absensi->id_karyawan = $_POST['id_karyawan'];
        $absensi->jam = $_POST['jam'];
        $absensi->save();

        return redirect('absensi');
    }
    public function delete($id)
    {
        $absensi =  Absensi::find($id);
        $absensi->delete();
        return redirect('absensi');
    }
}
