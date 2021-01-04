<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Izin;
use App\User;

class IzinController extends Controller
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
            $data['izin'] = Izin::join('user', 'izin.id_karyawan', '=', 'user.id')->select('izin.*', 'user.nama')->get();
        } else {
            $data['izin'] = Izin::join('user', 'izin.id_karyawan', '=', 'user.id')->select('izin.*', 'user.nama')->where('izin.id_karyawan',Auth::user()->id)->get();
        }
        $data['user'] = User::all();
        return view('izin', $data);
    }

    public function insert(Request $request)
    {
        $izin = new Izin;
        $izin->id_karyawan = $_POST['id_karyawan'];
        $izin->izin = $_POST['izin'];
        $izin->alasan = $_POST['alasan'];
        $izin->save();

        return redirect('izin');
    }
    public function edit($id, Request $request)
    {
        $izin =  Izin::find($id);
        $izin->id_karyawan = $_POST['id_karyawan'];
        $izin->hari = $_POST['hari'];
        $izin->alasan = $_POST['alasan'];
        $izin->save();

        return redirect('izin');
    }
    public function delete($id)
    {
        $izin =  Izin::find($id);
        $izin->delete();
        return redirect('izin');
    }

    public function setuju($id)
    {
        $izin = Izin::find($id);
        $izin->status = 'setuju';
        $izin->save();
        return redirect('izin');
    }
    public function tolak($id)
    {
        $izin = Izin::find($id);
        $izin->status = 'tolak';
        $izin->save();

        return redirect('izin');
    }
}
