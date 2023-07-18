<?php

namespace App\Http\Controllers;

use App\Imports\ImportAlternatif;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AlternatifController extends Controller
{
    public function index()
    {
        $data['alternatif'] = Alternatif::with('subkriteria')->get();
        $data['title'] = 'Alternatif';
        return view('admin.alternatif.index', $data);
    }


    public function create()
    {
        $data['title'] = 'Tambah Sub Kriteria';
        return view('admin.alternatif.addalternatif', $data);
    }


    public function store(Request $request)
    {
        Alternatif::create($request->all());

        return redirect()->route('alternatif.index');
    }

    // import
    public function import(Request $request)
    {
        
        $file = $request->file('import');
    	Excel::import(new ImportAlternatif, $file);
    	return back()->with('status', 'Data Berhasil Diimport');
    }



    public function edit($id)
    {
        $data['title'] = 'Tambah Alternatif';
        $data['alternatif'] = Alternatif::find($id);

        return view('admin.alternatif.editalternatif', $data);
    }


    public function update(Request $request, $id)
    {
        $alternatif = Alternatif::find($id);
        $alternatif->update($request->all());

        return redirect()->route('alternatif.index');
    }


    public function destroy($id)
    {
        $alternatif = Alternatif::find($id);
        $alternatif->delete();
        return redirect()->route('alternatif.index');
    }
}
