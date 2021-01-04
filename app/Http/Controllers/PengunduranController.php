<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Pengunduran;
use App\User;

class PengunduranController extends Controller
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
        $data['pengunduran'] = Pengunduran::join('user', 'pengunduran.id_karyawan', '=', 'user.id')->select('pengunduran.*', 'user.nama')->get();
        $data['user'] = User::all();
        return view('pengunduran', $data);
    }

    public function insert(Request $request)
    {

        if ($files = $request->file('foto_surat_pengunduran')) {
            $name = $files->getClientOriginalName();
            $files->move('image_surat_pengunduran', $name);
        }
        $pengunduran = new Pengunduran;
        $pengunduran->id_karyawan = $_POST['id_karyawan'];
        $pengunduran->tanggal = $_POST['tanggal'];
        $pengunduran->alasan = $_POST['alasan'];
        $pengunduran->surat_pengunduran = $name;
        $pengunduran->save();

        return redirect('pengunduran');
    }
    public function edit($id, Request $request)
    {
        $pengunduran =  Pengunduran::find($id);
        $pengunduran->id_karyawan = $_POST['id_karyawan'];
        $pengunduran->tanggal = $_POST['tanggal'];
        $pengunduran->alasan = $_POST['alasan'];
        $pengunduran->save();

        return redirect('pengunduran');
    }
    public function delete($id)
    {
        $pengunduran =  Pengunduran::find($id);
        $pengunduran->delete();
        return redirect('pengunduran');
    }

    public function setuju($id)
    {
        $cuti = Pengunduran::find($id);
        $cuti->status = 'setuju';
        $cuti->save();
        return redirect('pengunduran');
    }
    public function tolak($id)
    {
        $cuti = Pengunduran::find($id);
        $cuti->status = 'tolak';
        $cuti->save();

        return redirect('pengunduran');
    }
}
