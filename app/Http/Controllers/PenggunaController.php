<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;

class PenggunaController extends Controller
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
        $data['pengguna'] = User::where('jabatan','!=','karyawan')->get();
        return view('pengguna', $data);
    }

    public function insert(Request $request)
    {
        $user = new User;
        $user->nama = $_POST['nama'];
        $user->username = $_POST['username'];
        $user->password = Hash::make($_POST['password']);
        $user->jabatan = $_POST['jabatan'];
        $user->save();

        return redirect('pengguna');
    }
    public function edit($id, Request $request)
    {
        $user =  User::find($id);
        $user->nama = $_POST['nama'];
        $user->username = $_POST['username'];
        $user->password = Hash::make($_POST['password']);
        $user->jabatan = $_POST['jabatan'];
        $user->save();

        return redirect('pengguna');
    }
    public function delete($id)
    {
        $user =  User::find($id);
        $user->delete();
        return redirect('pengguna');
    }
}
