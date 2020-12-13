<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Gaji;
use App\User;

class GajiController extends Controller
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
         $data['gaji'] = Gaji::join('user','gaji.id_karyawan','=','user.id')->select('gaji.*', 'user.nama')->get();
        $data['user'] = User::all();
        return view('gaji', $data);
    }

    public function insert(Request $request)
    {
        $gaji = new Gaji;
        $gaji->id_karyawan = $_POST['id_karyawan'];
        $gaji->gaji = $_POST['gaji'];
        $gaji->tanggal = $_POST['tanggal'];
        $gaji->save();

        return redirect('gaji');
    }
    public function edit($id, Request $request)
    {
        $gaji =  Gaji::find($id);
        $gaji->id_karyawan = $_POST['id_karyawan'];
        $gaji->gaji = $_POST['gaji'];
        $gaji->tanggal = $_POST['tanggal'];
        $gaji->save();

        return redirect('gaji');
    }
    public function delete($id)
    {
        $gaji =  Gaji::find($id);
        $gaji->delete();
        return redirect('gaji');
    }
}
