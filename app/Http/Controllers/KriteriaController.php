<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Kriteria;

class KriteriaController extends Controller
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
        $data['kriteria'] = Kriteria::all();
        $data['kode'] = Kriteria::orderBy('id', 'desc')->first();
        if ($data['kode'] != null) {
            $kode = Kriteria::orderBy('id', 'desc')->pluck('kode');
            $kode = substr($kode[0], 1);
            $kode++;
            $data['kode'] = 'K' . $kode;
        } else {
            $data['kode'] = 'K1';
        }

        return view('kriteria', $data);
    }

    public function insert(Request $request)
    {
        $kriteria = new Kriteria;
        $kriteria->kode = $_POST['kode'];
        $kriteria->nama = $_POST['nama'];
        $kriteria->bobot = $_POST['bobot'];
        $kriteria->save();

        return redirect('kriteria');
    }
    public function edit($id, Request $request)
    {
        $kriteria =  Kriteria::find($id);
        $kriteria->kode = $_POST['kode'];
        $kriteria->nama = $_POST['nama'];
        $kriteria->bobot = $_POST['bobot'];
        $kriteria->save();

        return redirect('kriteria');
    }
    public function delete($id)
    {
        $kriteria =  Kriteria::find($id);
        $kriteria->delete();
        return redirect('kriteria');
    }
}
