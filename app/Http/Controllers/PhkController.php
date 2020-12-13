<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Phk;
use App\User;

class PhkController extends Controller
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
        $data['phk'] = Phk::join('user','phk.id_karyawan','=','user.id')->select('phk.*', 'user.nama')->get();
        $data['user'] = User::all();
        return view('phk', $data);
    }

    public function insert(Request $request)
    {
        $phk = new Phk;
        $phk->id_karyawan = $_POST['id_karyawan'];
        $phk->tanggal = $_POST['tanggal'];
        $phk->alasan = $_POST['alasan'];
        $phk->save();

        return redirect('phk');
    }
    public function edit($id, Request $request)
    {
        $phk =  Phk::find($id);
        $phk->id_karyawan = $_POST['id_karyawan'];
        $phk->tanggal = $_POST['tanggal'];
        $phk->alasan = $_POST['alasan'];
        $phk->save();

        return redirect('phk');
    }
    public function delete($id)
    {
        $phk =  Phk::find($id);
        $phk->delete();
        return redirect('phk');
    }
}
