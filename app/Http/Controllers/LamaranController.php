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
        $data['lamaran'] = Lamaran::all();
        return view('lamaran', $data);
    }

    public function insert(Request $request)
    {
        $lamaran = new Lamaran;
        $lamaran->nama = $_POST['nama'];
        $lamaran->posisi = $_POST['posisi'];
        $lamaran->asal = $_POST['asal'];
        $lamaran->save();

        return redirect('lamaran');
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
