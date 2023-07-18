<?php

namespace App\Http\Controllers;

use App\Models\avgPerbandinganKriteria;
use App\Models\Kriteria;

use Illuminate\Http\Request;

class RespondenController extends Controller
{
    public function index(){
        $data['title'] = 'Responden';
        $data['geomean'] = avgPerbandinganKriteria::with('Kriteria1', 'Kriteria2')->get();
        $data['kriteria'] = Kriteria::get();
        return view('admin.responden.index', $data);
    }
}
