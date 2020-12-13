<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Sp;
use App\User;

class SpController extends Controller
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
        $data['sp'] = Sp::join('user','sp.id_karyawan','=','user.id')->select('sp.*', 'user.nama')->get();
        $data['user'] = User::all();
        return view('sp', $data);
    }

    public function insert(Request $request)
    {
        $sp = new Sp;
        $sp->id_karyawan = $_POST['id_karyawan'];
        $sp->tanggal = $_POST['tanggal'];
        $sp->alasan = $_POST['alasan'];
        $sp->save();

        return redirect('sp');
    }
    public function edit($id, Request $request)
    {
        $sp =  Sp::find($id);
        $sp->id_karyawan = $_POST['id_karyawan'];
        $sp->tanggal = $_POST['tanggal'];
        $sp->alasan = $_POST['alasan'];
        $sp->save();

        return redirect('sp');
    }
    public function delete($id)
    {
        $sp =  Sp::find($id);
        $sp->delete();
        return redirect('sp');
    }
}
