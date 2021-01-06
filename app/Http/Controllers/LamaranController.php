<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Lamaran;

class LamaranController extends Controller
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
        $data['lamaran'] = Lamaran::join('user','lamaran.id_pelamar','=','user.id')->join('iklan_lowongan_kerja','lamaran.id_lowongan_kerja','=','iklan_lowongan_kerja.id')->select('iklan_lowongan_kerja.nama as nama_loker','user.nama as nama_user','lamaran.cv')->get();
        return view('lamaran', $data);
    }

    public function insert(Request $request)
    {
        if ($files = $request->file('foto_cv')) {
            $name = $files->getClientOriginalName();
            $files->move('image_cv', $name);
        }
        $lamaran = new Lamaran;
        $lamaran->id_pelamar = Auth::user()->id;
        $lamaran->id_lowongan_kerja = $_POST['id_lowongan_kerja'];
        $lamaran->cv = $name;
        $lamaran->save();

        return redirect('home');
    }
    public function edit($id, Request $request)
    {
        $lamaran =  Lamaran::find($id);
        $lamaran->nama = $_POST['nama'];
        $lamaran->posisi = $_POST['posisi'];
        $lamaran->asal = $_POST['asal'];
        $lamaran->save();

        return redirect('lamaran');
    }
    public function delete($id)
    {
        $lamaran =  Lamaran::find($id);
        $lamaran->delete();
        return redirect('lamaran');
    }
}
