<?php

namespace App\Http\Controllers;

use App\Models\Quisioner;
use Illuminate\Http\Request;
use App\Models\JenisQuisioner;
use App\Models\ListPertanyaan;

class ListPertanyaanController extends Controller
{
    public function index()
    {
        $data['list'] = ListPertanyaan::with('jenisQuisioner')->get();
        $data['title'] = 'List Pertanyaan Kuis';
        return view('admin.list-pertanyaan.index', $data);
    }

    public function create()
    {
        $data['quisioner'] = Quisioner::all();
        $data['title'] = 'Tambah List Pertanyaan';

        return view('admin.list-pertanyaan.addList', $data);
    }

    public function create_new()
    {
        $data['quisioner'] = Quisioner::all();
        $data['title'] = 'Tambah List Pertanyaan';

        return view('admin.list-pertanyaan.addList', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        ListPertanyaan::create([
            'judul_pertanyaan' => $request->judul_pertanyaan,
            'id_jenis_quisioner' =>  $request->id_jenis_quisioner,
        ]);

        // return redirect()->route('list-pertanyaan.index');
        return redirect()->route('kuisioner.index');
    }


    public function edit($id)
    {
        $data['title'] = 'Tambah Jenis Kuis';
        $data['list'] = ListPertanyaan::with('jenisQuisioner')->find($id);
        return view('admin.list-pertanyaan.ubahList', $data);
    }

    public function update(Request $request, $id)
    {

        $jenis = ListPertanyaan::find($id);
        $jenis->update([
            'judul_pertanyaan' => $request->judul_pertanyaan,
        ]);
        return redirect()->route('kuisioner.index');

        // return redirect()->route('list-pertanyaan.index');
    }
    public function destroy($id)
    {

        $jenis = ListPertanyaan::find($id);
        $jenis->delete();
        return redirect()->route('kuisioner.index');

        // return redirect()->route('list-pertanyaan.index');
    }

    public function getJenisQuisioner(Request $request)
    {
        $data['jenis'] = JenisQuisioner::where('id_quisioner', $request->id)->get();
        return response()->json($data);
    }
}
