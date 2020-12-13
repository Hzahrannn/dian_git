<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Cuti;
use App\User;

class CutiController extends Controller
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
        $data['cuti'] = Cuti::join('user','cuti.id_karyawan','=','user.id')->select('cuti.*', 'user.nama')->get();
        $data['user'] = User::all();
        return view('cuti', $data);
    }

    public function insert(Request $request)
    {
        $cuti = new Cuti;
        $cuti->id_karyawan = $_POST['id_karyawan'];
        $cuti->dari = $_POST['dari'];
        $cuti->sampai = $_POST['sampai'];
        $cuti->save();

        return redirect('cuti');
    }
    public function edit($id, Request $request)
    {
        $cuti =  Cuti::find($id);
        $cuti->id_karyawan = $_POST['id_karyawan'];
        $cuti->dari = $_POST['dari'];
        $cuti->sampai = $_POST['sampai'];
        $cuti->save();

        return redirect('cuti');
    }
    public function delete($id)
    {
        $cuti =  Cuti::find($id);
        $cuti->delete();
        return redirect('cuti');
    }
    public function setuju($id)
    {
        $cuti = Cuti::find($id);
        $cuti->status = 'setuju';
        $cuti->save();
        return redirect('cuti');
    }
    public function tolak($id)
    {
        $cuti = Cuti::find($id);
        $cuti->status = 'tolak';
        $cuti->save();

        return redirect('cuti');
    }

}
