<?php

namespace App\Http\Controllers;

use App\Imports\ImportKriteria;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class KriteriaController extends Controller
{

    public function index()
    {
        $data['kriteria'] = Kriteria::all();
        $data['title'] = 'Kriteria';
        return view('admin.kriteria.index', $data);
    }


    public function create()
    {
        $data['title'] = 'Tambah Kriteria';
        return view('admin.kriteria.addKriteria', $data);
    }


    public function store(Request $request)
    {
        Kriteria::create($request->all());

        return redirect()->route('kriteria.index');
    }

    public function import(Request $request)
    {
        
        $file = $request->file('import');
    	Excel::import(new ImportKriteria, $file);
    	return back()->with('status', 'Data Berhasil Diimport');
    }



    public function edit($id)
    {
        $data['title'] = 'Tambah Kriteria';
        $data['kriteria'] = Kriteria::find($id);

        return view('admin.kriteria.editKriteria', $data);
    }




    public function update(Request $request, $id)
    {
        $kriteria = Kriteria::find($id);
        $kriteria->update($request->all());

        return redirect()->route('kriteria.index');
    }

    public function updatestatus(Request $request, $id)
    {
        $kriteria = Kriteria::find($id);

        if($kriteria->status =='1'){
            $status = '0';
        }else{
            $status = '1';
        }

        $kriteria->update(['status' => $status]);

        return redirect()->route('kriteria.index')->with('status', 'Status Kriteria Telah dirubah');
    }


    public function destroy($id)
    {
        $kriteria = Kriteria::find($id);
        $kriteria->delete();
        return redirect()->route('kriteria.index');

    }
}
