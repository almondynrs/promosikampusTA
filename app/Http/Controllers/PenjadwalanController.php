<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenjadwalanController extends Controller
{
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

        $data['title'] = 'Data Penjadwalan Kunjungan';
        return view('admin.penjadwalan.index', $data);
    }
}
