<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Demosi;
use App\User;

class DemosiController extends Controller
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
         $data['demosi'] = Demosi::join('user','demosi.id_karyawan','=','user.id')->select('demosi.*', 'user.nama')->get();
        $data['user'] = User::all();
        return view('demosi', $data);
    }

    public function insert(Request $request)
    {
        $demosi = new Demosi;
        $demosi->id_karyawan = $_POST['id_karyawan'];
        $demosi->jabatan = $_POST['jabatan'];
        $demosi->save();

        $d1 = $_POST['jabatan'];
        $demot = User::where('id', $_POST['id_karyawan'])->update(['jabatan'=>$_POST['jabatan']]);
        return redirect('demosi');
    }

    public function edit($id, Request $request)
    {
        $gaji =  Demosi::find($id);
        $gaji->id_karyawan = $_POST['id_karyawan'];
        $gaji->jabatan = $_POST['jabatan'];
        $gaji->save();

        return redirect('demosi');
    }
    
    public function delete($id)
    {
        $demosi =  Demosi::find($id);
        $demosi->delete();
        return redirect('demosi');
    }
}
