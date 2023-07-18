<?php

namespace App\Http\Controllers;

use App\Models\JenisQuisioner;
use App\Models\Quisioner;
use Illuminate\Http\Request;

class JenisQuisionerController extends Controller
{
    public function index()
    {
        $data['jenis'] = JenisQuisioner::with('quisioner')->get();
        $data['title'] = 'Jenis Kuisioner';
        return view('admin.jenis-quisioner.index', $data);
    }

    public function create($id)
    {
        $data['quisioner'] = Quisioner::find($id);
        $data['title'] = 'Tambah Jenis Kuisioner';

        return view('admin.jenis-quisioner.addJenis', $data);
    }

    public function create_new()
    {
        $data['quisioner'] = Quisioner::all();
        $data['title'] = 'Tambah Jenis Kuisioner';

        return view('admin.jenis-quisioner.addJenisNew', $data);
    }


    public function store(Request $request)
    {


        $id = Quisioner::where('question', $request->id_quisioner)->first()->id ?? $request->id_quisioner;


        // dd($id);
        JenisQuisioner::create([
            'nama_jenis' => $request->nama_jenis,
            'id_quisioner' => $id
        ]);
        return redirect()->route('kuisioner.index');

        // return redirect()->route('kuisioner.show', ['id' => $id]);
    }


    public function edit($id)
    {
        $data['title'] = 'Tambah Jenis Kuisioner';
        $data['jenis'] = JenisQuisioner::with('quisioner')->find($id);
        return view('admin.jenis-quisioner.editJenis', $data);
    }

    public function update(Request $request, $id)
    {

        $jenis = JenisQuisioner::with('quisioner')->find($id);
        $jenis->update([
            'nama_jenis' => $request->nama_jenis,
        ]);
        return redirect()->route('kuisioner.index');

        // return redirect()->route('jenis-kuis.index');
    }
    public function destroy($id)
    {

        $jenis = JenisQuisioner::with('quisioner')->find($id);
        $jenis->delete();
        return redirect()->route('kuisioner.index');

        // return redirect()->route('jenis-kuis.index');
    }
}
