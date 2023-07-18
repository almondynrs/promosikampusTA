<?php

namespace App\Http\Controllers;

use App\Models\JenisQuisioner;
use App\Models\ListPertanyaan;
use App\Models\Quisioner;
use Illuminate\Http\Request;

class QuisionerController extends Controller
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

        $data['title'] = 'Data Kuisioner';
        $data['kuisioner'] = Quisioner::all();
        $data['list'] = ListPertanyaan::with('jenisQuisioner')->get();
        $data['jenis'] = JenisQuisioner::with('quisioner')->get();
        return view('admin.quisioner.index', $data);
    }



    public function create()
    {
        $data['title'] = 'Buat Kuisioner';
        return view('admin.quisioner.addQuisioner', $data);
    }

    public function store(Request $request)
    {
        Quisioner::create($request->all());

        return redirect()->route('kuisioner.index');
    }

    public function show($id)
    {
        $data['title'] = 'Detail Kuisioner';
        $data['quisioner'] = Quisioner::with('jenisQuisioner')->find($id);

        // dd($data);
        return view('admin.quisioner.detailQuisioner', $data);
    }
    public function edit($id)
    {
        $data['title'] = 'Edit Kuisioner';
        $data['quisioner'] = Quisioner::find($id);

        return view('admin.quisioner.ubahQuisioner', $data);
    }
    public function update($id, Request $request)
    {
        $kuis = Quisioner::find($id);
        $kuis->update($request->all());

        return redirect()->route('kuisioner.index');
    }

    public function destroy($id)
    {

        Quisioner::find($id)->delete();

        return redirect()->route('kuisioner.index');
    }
}
