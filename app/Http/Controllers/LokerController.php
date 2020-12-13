<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Loker;

class LokerController extends Controller
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
        $data['loker'] = Loker::all();
        return view('loker', $data);
    }

    public function insert(Request $request)
    {
        $loker = new Loker;
        $loker->nama = $_POST['nama'];
        $loker->deskripsi = $_POST['deskripsi'];
        $loker->gaji = $_POST['gaji'];
        $loker->save();

        return redirect('loker');
    }
    public function edit($id, Request $request)
    {
        $loker =  Loker::find($id);
        $loker->nama = $_POST['nama'];
        $loker->deskripsi = $_POST['deskripsi'];
        $loker->gaji = $_POST['gaji'];
        $loker->save();

        return redirect('loker');
    }
    public function delete($id)
    {
        $loker =  Loker::find($id);
        $loker->delete();
        return redirect('loker');
    }
}
