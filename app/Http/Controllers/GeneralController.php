<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\avgPerbandinganKriteria;
use App\Models\avgPerbandinganSubkriteria;
use App\Models\Quisioner;
use Illuminate\Http\Request;
use App\Models\JenisQuisioner;
use App\Models\PertanyaanResponden;
use App\Models\SchoolDetail;
use App\Models\Kriteria;
use App\Models\Responden;
use App\Models\Q_answer;
use App\Models\SubKriteria;
use App\Models\user;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class GeneralController extends Controller
{

    public function index(Request $request)
    {

        $data['school'] = SchoolDetail::get();

        return view('general.quisioner.quisioner', $data);
    }
    public function saveSession(Request $request)
    {
        $usersData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => '',
            'user_image' => ''
        ];
        $idu = User::create($usersData);

        $respondenData = [
            'user' => $idu->id,
            'school' => $request->school,
        ];

        $idr = Responden::create($respondenData);

        $sessionrespondenData = [
            'id_responden' => $idr->id,
            'role' => $request->role,
            'name' => $request->name,
            'school' => $request->school,
            'email' => $request->email
        ];

        Session::put('responden', $sessionrespondenData);

        return redirect()->route('general.quisionerM');
    }

    public function quisionerM()
    {
        $responden = Session::get('responden');

        // dd($responden);
        // Mengirim data responden ke view

        $data['responden'] = $responden;

        $datajawabankriteria = PertanyaanResponden::where('id_responden', $responden)->where('k1', '!=', '0')->first();
        $datajawabansub = PertanyaanResponden::where('id_responden', $responden)->where('s1', '!=', '0')->first();
        $datajawabanal = PertanyaanResponden::where('id_responden', $responden)->where('a1', '!=', '0')->first();

        if (empty($datajawabankriteria)) {
            $data['quisioner'] = JenisQuisioner::with('listPertanyaan')->where('id', '4')->first();
            $data['perbandingan'] = Kriteria::get();

            return view('general.quisioner.quisionerM', $data);
        } else if (empty($datajawabansub)) {
            $data['quisioner'] = JenisQuisioner::with('listPertanyaan')->where('id', '5')->first();
            $data['kriteria'] = Kriteria::get();

            return view('general.quisioner.quisionerS', $data);
        } elseif (empty($datajawabanal)) {
            $data['quisioner'] = JenisQuisioner::with('listPertanyaan')->where('id', '6')->first();
            $data['kriteria'] = Kriteria::get();

            $data['sub'] = SubKriteria::with('kriteria')->get();
            $data['perbandingan'] = Alternatif::with('subkriteria')->select('nama_alternatif as nama')->get();
            return view('general.quisioner.quisionerA', $data);
        } else {
            return redirect()->route('general.index');
        }
    }

    public function saveSessionQusionerM(Request $request)
    {
        //input nilai inputan perbandingan kriteria

        $perbandingan = Kriteria::get();

        $i = 1;
        foreach ($request->atas as $index1 => $a) {
            foreach ($a as $index2 => $nilai) {

                $nilai_atas = $nilai;
                $nilai_bawah = $request->bawah[$index1][$index2];
                if ($nilai_atas > 0) {
                    $nilai_inputan = $nilai_atas;
                } else if ($nilai_bawah > 0) {
                    $nilai_inputan = 1 / $nilai_bawah;
                } else {
                    throw ValidationException::withMessages(['Nilai Perbandingan Kedua Kriteria Tidak Boleh 0']);
                }


                // input data jawaban responden

                $nilaiJawaban = [
                    'id_responden' => Session::get('responden')['id_responden'],
                    'quisioner' => $request->jenis,
                    'id_list' => $request->input('id_list'),
                    'k1' =>  intval($index1),
                    'k2' =>  intval($index2),
                    's1' => 0,
                    's2' => 0,
                    'a1' => 0,
                    'a2' => 0,
                    'selected' => $request->input('levelselected_' . $i),
                    'value' => $nilai_inputan,
                ];
                PertanyaanResponden::insert($nilaiJawaban);


                //input ke tabel rata2 geomean
                $rata_kriteria = avgPerbandinganKriteria::where('kriteria_id1', '=', $index1)
                    ->where('kriteria_id2', '=', $index2)->first();
                if ($rata_kriteria == null) {
                    avgPerbandinganKriteria::create([
                        'kriteria_id1' => intval($index1),
                        'kriteria_id2' => intval($index2),
                        'avg' => pow($nilai_inputan, (float)(1 / 1)),
                    ]);
                } else {
                    if ($rata_kriteria->avg != 0) { //mencegah nilai geoman 0 trs
                        $product = $nilai_inputan * $rata_kriteria->avg;
                    } else {
                        $product = $nilai_inputan;
                    }

                    $gm = pow($product, (float)(1 / 2));

                    $rata_kriteria->update([
                        'avg' => $gm,
                    ]);
                }

                $i++;
            }
        }

        return redirect()->route('general.quisionerM');
    }

    public function saveSessionQusionerS(Request $request)
    {
        $input = $request->input;
        $result = [];

        foreach ($input as $k1 => $subArray) {

            foreach ($subArray as $k2 => $value) {
                $s1 = $request->input('perbandingan' . $k2);
                $s2 = $request->input('perbandingan' . $k2 + 1);
                $selected = $request->input('levelselected_' . $k1);

                if ($value != 0) {

                    if ($k2 === $k1 * 2) {
                        $s1 = $request->input('perbandingan' . $k2 - 1);
                        $s2 = $request->input('perbandingan' . $k2);
                        if ($value !== 0) {
                            $value = 1 / $value;
                        } else {
                            break;
                            throw ValidationException::withMessages(['Nilai Perbandingan Kedua Kriteria Tidak Boleh 0']);
                        }
                    }


                    $nilaiJawaban[] = [
                        'id_responden' => Session::get('responden')['id_responden'],
                        'quisioner' => $request->jenis,
                        'id_list' => $request->id_list,
                        'k1' => 0,
                        'k2' => 0,
                        's1' => $s1,
                        's2' => $s2,
                        'a1' => 0,
                        'a2' => 0,
                        'selected' => $selected,
                        'value' => $value,
                    ];

                    PertanyaanResponden::insert($nilaiJawaban);

                    //input ke tabel rata2 geomean
                    $rata_subkriteria = avgPerbandinganSubkriteria::where('subkriteria_id1', '=', $s1)
                        ->where('subkriteria_id2', '=', $s2)->first();
                    if ($rata_subkriteria == null) {
                        avgPerbandinganSubkriteria::create([
                            'subkriteria_id1' => $s1,
                            'subkriteria_id2' => $s2,
                            'avg' => pow($value, (float)(1 / 1)),
                        ]);
                    } else {
                        if ($rata_subkriteria->avg != 0) { //mencegah nilai geoman 0 trs
                            $product = $value * $rata_subkriteria->avg;
                        } else {
                            $product = $value;
                        }

                        $gm = pow($product, (float)(1 / 2));

                        $rata_subkriteria->update([
                            'avg' => $gm,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('general.quisionerM');
    }

    public function saveSessionQusionerA(Request $request)
    {
        //dd($request);
        session()->flush();
        return view('general.quisioner.quisioner4');

        //input nilai inputan perbandingan alternatif
        // $perbandingan = alternatif::get();

        // $i = 1;
        // foreach ($request->atas as $index1 => $a) {
        //     foreach ($a as $index2 => $nilai) {

        //         $nilai_atas = $nilai;
        //         $nilai_bawah = $request->bawah[$index1][$index2];
        //         if ($nilai_atas > 0) {
        //             $nilai_inputan = $nilai_atas;
        //         } else if ($nilai_bawah > 0) {
        //             $nilai_inputan = 1 / $nilai_bawah;
        //         } else {
        //             throw ValidationException::withMessages(['Nilai Perbandingan Kedua alternatif Tidak Boleh 0']);
        //         }


        //         // input data jawaban responden

        //         $nilaiJawaban = [
        //             'id_responden' => Session::get('responden')['id_responden'],
        //             'quisioner' => $request->jenis,
        //             'id_list' => $request->input('id_list'),
        //             'k1' =>  intval($index1),
        //             'k2' =>  intval($index2),
        //             's1' => 0,
        //             's2' => 0,
        //             'a1' => 0,
        //             'a2' => 0,
        //             'selected' => $request->input('levelselected_' . $i),
        //             'value' => $nilai_inputan,
        //         ];
        //         PertanyaanResponden::insert($nilaiJawaban);


        //         //input ke tabel rata2 geomean
        //         $rata_alternatif = avgPerbandinganalternatif::where('alternatif_id1', '=', $index1)
        //             ->where('alternatif_id2', '=', $index2)->first();
        //         if ($rata_alternatif == null) {
        //             avgPerbandinganalternatif::create([
        //                 'alternatif_id1' => intval($index1),
        //                 'alternatif_id2' => intval($index2),
        //                 'avg' => pow($nilai_inputan, (float)(1 / 1)),
        //             ]);
        //         } else {
        //             if ($rata_alternatif->avg != 0) { //mencegah nilai geoman 0 trs
        //                 $product = $nilai_inputan * $rata_alternatif->avg;
        //             } else {
        //                 $product = $nilai_inputan;
        //             }

        //             $gm = pow($product, (float)(1 / 2));

        //             $rata_alternatif->update([
        //                 'avg' => $gm,
        //             ]);
        //         }

        //         $i++;
        //     }
        // }

        return redirect()->route('general.quisionerM');
    }
}
