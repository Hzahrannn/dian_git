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
        if (Auth::user()->jabatan != 'karyawan') {
            $data['demosi'] = Demosi::join('user', 'demosi.id_karyawan', '=', 'user.id')->select('demosi.*', 'user.nama')->get();
        }else{
            $data['demosi'] = Demosi::join('user', 'demosi.id_karyawan', '=', 'user.id')->select('demosi.*', 'user.nama')->where('demosi.id_karyawan',Auth::user()->id)->get();
        }
        $data['user'] = User::where('jabatan', 'karyawan')->get();
        return view('demosi', $data);
    }

    public function insert(Request $request)
    {
        if ($files = $request->file('foto_surat_demosi')) {
            $name = $files->getClientOriginalName();
            $files->move('image_surat_demosi', $name);
        }
        $demosi = new Demosi;
        $demosi->id_karyawan = $_POST['id_karyawan'];
        $demosi->surat_demosi = $name;
        $demosi->keputusan = $_POST['keputusan'];
        $demosi->save();

        // $d1 = $_POST['jabatan'];
        // $demot = User::where('id', $_POST['id_karyawan'])->update(['jabatan'=>$_POST['jabatan']]);
        return redirect('demosi');
    }

    public function edit($id, Request $request)
    {
        if ($files = $request->file('foto_surat_demosi')) {
            $name = $files->getClientOriginalName();
            $files->move('image_surat_demosi', $name);
        }
        $demosi =  Demosi::find($id);
        $demosi->id_karyawan = $_POST['id_karyawan'];
        $demosi->surat_demosi = $name;
        $demosi->keputusan = $_POST['keputusan'];
        $demosi->save();

        return redirect('demosi');
    }

    public function delete($id)
    {
        $demosi =  Demosi::find($id);
        $demosi->delete();
        return redirect('demosi');
    }
}
