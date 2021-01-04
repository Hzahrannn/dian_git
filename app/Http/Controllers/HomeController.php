<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Iklan_lowongan_kerja;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['iklan_lowongan_kerja'] = Iklan_lowongan_kerja::orderBy('id','DESC')->get();
        return view('home', $data);
    }
    public function welcome()
    {
        $data['iklan_lowongan_kerja'] = Iklan_lowongan_kerja::orderBy('id','DESC')->get();
        return view('welcome', $data);
    }
}
