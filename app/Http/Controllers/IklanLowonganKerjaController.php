<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Iklan_lowongan_kerja;
use App\Lamaran;

class IklanLowonganKerjaController extends Controller
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
        $data['iklan_lowongan_kerja'] = Iklan_lowongan_kerja::orderBy('id','DESC')->get();
        return view('iklan_lowongan_kerja', $data);
    }

    public function detail($id)
    {
        $data['iklan_lowongan_kerja'] = Iklan_lowongan_kerja::where('id',$id)->get();
        $data['lamaran'] = Lamaran::where('id_pelamar',Auth::user()->id)->where('id_lowongan_kerja',$id)->get();
        $data['id'] = $id;
        return view('detail_iklan_lowongan_kerja', $data);
    }

    public function insert(Request $request)
    {
        $iklan_lowongan_kerja = new Iklan_lowongan_kerja;
        $iklan_lowongan_kerja->judul = $_POST['judul'];
        $iklan_lowongan_kerja->nama = $_POST['nama'];
        $iklan_lowongan_kerja->deskripsi = $_POST['deskripsi'];
        $iklan_lowongan_kerja->gaji = $_POST['gaji'];
        $iklan_lowongan_kerja->save();

        return redirect('iklan_lowongan_kerja');
    }
    public function edit($id, Request $request)
    {
        $iklan_lowongan_kerja =  Iklan_lowongan_kerja::find($id);
        $iklan_lowongan_kerja->judul = $_POST['judul'];
        $iklan_lowongan_kerja->nama = $_POST['nama'];
        $iklan_lowongan_kerja->deskripsi = $_POST['deskripsi'];
        $iklan_lowongan_kerja->gaji = $_POST['gaji'];
        $iklan_lowongan_kerja->save();

        return redirect('iklan_lowongan_kerja');
    }
    public function delete($id)
    {
        $iklan_lowongan_kerja =  Iklan_lowongan_kerja::find($id);
        $iklan_lowongan_kerja->delete();
        return redirect('iklan_lowongan_kerja');
    }
}
