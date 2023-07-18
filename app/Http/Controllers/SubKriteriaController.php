<?php

namespace App\Http\Controllers;

use App\Imports\ImportSubKriteria;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SubKriteriaController extends Controller
{

    public function index()
    {
        $data['sub'] = SubKriteria::with('kriteria')->get();
        $data['title'] = 'Sub Kriteria';
        return view('admin.subKriteria.index', $data);
    }


    public function create()
    {
        $data['kriteria'] = Kriteria::where('status','1')->get();
        $data['title'] = 'Tambah Sub Kriteria';
        return view('admin.subKriteria.addsubKriteria', $data);
    }

    // import
    public function import(Request $request)
    {
        
        $file = $request->file('import');
    	Excel::import(new ImportSubKriteria, $file);
    	return back()->with('status', 'Data Berhasil Diimport');
    }


    public function store(Request $request)
    {
        SubKriteria::create($request->all());

        return redirect()->route('subKriteria.index');
    }



    public function edit($id)
    {
        $data['title'] = 'Tambah subKriteria';
        $data['kriteria'] = Kriteria::all();
        $data['sub'] = SubKriteria::withCount('kriteria')->find($id);

        return view('admin.subKriteria.editsubKriteria', $data);
    }


    public function update(Request $request, $id)
    {
        $subKriteria = SubKriteria::find($id);
        $subKriteria->update($request->all());

        return redirect()->route('subKriteria.index');
    }


    public function destroy($id)
    {
        $subKriteria = SubKriteria::find($id);
        $subKriteria->delete();
        return redirect()->route('subKriteria.index');

    }
}
