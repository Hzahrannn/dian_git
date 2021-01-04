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
        if (Auth::user()->jabatan == 'hrd') {
            $data['absensi'] = Absensi::join('user', 'absensi.id_karyawan', '=', 'user.id')->select('absensi.*', 'user.nama')->get();
            $data['user'] = User::all();
        }elseif(Auth::user()->jabatan == 'karyawan'){
            $data['absensi'] = Absensi::join('user', 'absensi.id_karyawan', '=', 'user.id')->select('absensi.*', 'user.nama')->where('absensi.id_karyawan',Auth::user()->id)->get();
            $data['user'] = User::where('id',Auth::user()->id)->get();
        }

        return view('absensi', $data);
    }

    public function insert(Request $request)
    {
        $absensi = new Absensi;
        $absensi->id_karyawan = Auth::user()->id;
        $absensi->jam_masuk = $_POST['jam'];
        $absensi->save();

        return redirect('absensi');
    }
    public function absen_pulang($id, Request $request)
    {
        $absensi =  Absensi::find($id);
        $absensi->jam_pulang = $_POST['jam_pulang'];
        $absensi->save();

        return redirect('absensi');
    }
    public function edit($id, Request $request)
    {
        $absensi =  Absensi::find($id);
        $absensi->jam_masuk = $_POST['jam'];
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
