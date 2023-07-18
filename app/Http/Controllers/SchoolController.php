<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolDetail;

class SchoolController extends Controller
{
    public function index()
    {
        $data['sekolah'] = SchoolDetail::all();
        $data['title'] = 'Data Sekolah';
        return view('admin.school.index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Data Sekolah';
        return view('admin.school.addSchool', $data);
    }

    public function store(Request $request)
    {
        SchoolDetail::create($request->all());

        return redirect()->route('sekolah.index');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data Sekolah';
        $data['sekolah'] = SchoolDetail::find($id);

        return view('admin.school.editSchool', $data);
    }


    public function update(Request $request, $id)
    {
        $sekolah = SchoolDetail::find($id);
        $sekolah->update($request->all());

        return redirect()->route('sekolah.index');
    }


    public function destroy($id)
    {
        $sekolah = SchoolDetail::find($id);
        $sekolah->delete();
        return redirect()->route('sekolah.index');

    }
}
