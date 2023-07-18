<?php

namespace App\Http\Controllers;

use App\Models\Schedule as ModelsSchedule;
use App\Models\SchoolDetail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Schedule extends Controller
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
        return view('admin.schedule.index', $data);
    }

    public function tambahSchedule(Request $request)
    {
        $data['title'] = 'Tambah Penjadwalan Kunjungan';

        $data['pegawaiAll'] = User::where('role', '=', '6')
            ->get();
        $data['school'] = SchoolDetail::get();
        if ($request->isMethod('post')) {
            // dd($request);
            $this->validate($request, [
                'school' => 'required',
                'date' => 'required',
                'pic1' => 'required',
                'pic2' => 'required',
                'surat_dinas' => 'file|mimes:pdf|max:1024',
                'description' => 'required',
            ]);

            $img = null;
            if ($request->file('surat_dinas')) {
                $nama_gambar = time() . '_' . $request->file('surat_dinas')->getClientOriginalName();
                $upload = $request->surat_dinas->storeAs('admin/upload/surat_dinas', $nama_gambar, 'public');
                $img = Storage::url($upload);
            }
            ModelsSchedule::create([
                'school_id' => $request->school,
                'date' => $request->date,
                'pic_1' => $request->pic1,
                'pic_2' => $request->pic2,
                'surat_dinas' => $img,
                'pic_1_status' => '0',
                'pic_2_status' => '0',
                'description' => $request->description,
                'status' => '0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->route('schedule.index')->with('status', 'Data telah tersimpan di database');
        }
        return view('admin.schedule.addschedule', $data);
    }
    public function dataTable(Request $request)
    {

        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
            0 => 'no',
            1 => 'pic_1',
            2 => 'pic_2',
            3 => 'school',
            4 => 'date',
            5 => 'surat_dinas',
            6 => 'status',
            7 => 'options',
        );

        if (Auth::user()->role == '6') {
            $totalDataRecord = ModelsSchedule::where('pic_1', Auth::id())
                ->orwhere('pic_2', Auth::id())
                ->count();
        } else {
            $totalDataRecord = ModelsSchedule::count();
        }
        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = 'date';
        $dir_val = 'DESC';

        if (empty($request->input('search.value'))) {

            if (Auth::user()->role == '6') {
                $schedule_data = ModelsSchedule::where('pic_1', Auth::id())
                    ->orwhere('pic_2', Auth::id())
                    ->offset($start_val)
                    ->limit($limit_val)
                    ->orderBy($order_val, $dir_val)
                    ->get();
            } else {
                $schedule_data = ModelsSchedule::offset($start_val)
                    ->limit($limit_val)
                    ->orderBy($order_val, $dir_val)
                    ->get();
            }
        } else {
            $search_text = $request->input('search.value');

            if (Auth::user()->role == '6') {

                $schedule_data =  ModelsSchedule::where('id', 'LIKE', "%{$search_text}%")
                    ->where('pic_1', Auth::id())
                    ->orwhere('pic_2', Auth::id())
                    // ->orWhere('name', 'LIKE', "%{$search_text}%")
                    // ->orWhere('email', 'LIKE', "%{$search_text}%")
                    ->offset($start_val)
                    ->limit($limit_val)
                    ->orderBy($orfder_val, $dir_val)
                    ->get();

                $totalFilteredRecord = ModelsSchedule::where('id', 'LIKE', "%{$search_text}%")
                    ->where('pic_1', Auth::id())
                    ->orwhere('pic_2', Auth::id())

                    // ->orWhere('name', 'LIKE', "%{$search_text}%")
                    // ->orWhere('email', 'LIKE', "%{$search_text}%")
                    ->count();
            } else {
                $schedule_data =  ModelsSchedule::where('id', 'LIKE', "%{$search_text}%")
                    // ->orWhere('name', 'LIKE', "%{$search_text}%")
                    // ->orWhere('email', 'LIKE', "%{$search_text}%")
                    ->offset($start_val)
                    ->limit($limit_val)
                    ->orderBy($order_val, $dir_val)
                    ->get();

                $totalFilteredRecord = ModelsSchedule::where('id', 'LIKE', "%{$search_text}%")
                    // ->orWhere('name', 'LIKE', "%{$search_text}%")
                    // ->orWhere('email', 'LIKE', "%{$search_text}%")
                    ->count();
            }
        }

        $data_val = array();
        if (!empty($schedule_data)) {
            foreach ($schedule_data as $i => $sch) {

                $url = route('schedule.edit', ['id' => $sch->id]);
                $urlHapus = route('schedule.delete', $sch->id);
                // if ($sch->surat_image) {
                $img = $sch->surat_image;
                // } else {
                //     $img = asset('vendor/adminlte3/img/user2-160x160.jpg');
                // }

                $pic1 =  User::where('id', $sch->pic_1)
                    ->first();
                $pic2 =  User::where('id', $sch->pic_2)
                    ->first();
                $school =  SchoolDetail::where('id', $sch->school_id)
                    ->get();

                if ($sch->pic_1_status == '1') {
                    $statuspic1 = '<br/><span class="bg-success badge badge-success" >Disetujui</span>';
                } else if ($sch->pic_1_status == '2') {
                    $statuspic1 = '<br/><span class="bg-danger badge badge-danger" >Ditolak</span>';
                } else {
                    $statuspic1 = '<br/><span class="bg-secondary badge badge-gray" >Dalam Konfirmasi</span>';
                }

                if ($sch->pic_2_status == '1') {
                    $statuspic2 = '<br/><span class="bg-success badge badge-success" >Disetujui</span>';
                } else if ($sch->pic_2_status == '2') {
                    $statuspic2 = '<br/><span class="bg-danger badge badge-danger" >Ditolak</span>';
                } else {
                    $statuspic2 = '<br/><span class="bg-secondary badge badge-gray" >Dalam Konfirmasi</span>';
                }

                if (Auth::user()->role == '6') {

                    //check user on data
                    $checkpic1 =  ModelsSchedule::where('id', $sch->id)
                        ->where(
                            'pic_1',
                            Auth::id()
                        )->count();
                    $checkpic2 =  ModelsSchedule::where('id', $sch->id)
                        ->where('pic_2', Auth::id())
                        ->count();

                    if ($checkpic1 > 0) {
                        $status = $sch->pic_1_status;
                    } else if ($checkpic2 > 0) {
                        $status = $sch->pic_2_status;
                    }
                    $urlconfirm = route('schedule.editconfirm', $sch->id);
                    if ($sch->pic_1_status !== '0' && $sch->pic_1 == Auth::user()->id) {
                        $action = "<p class='text-danger'>Status Sudah Tidak Bisa Dirubah</p>";
                    } else if ($sch->pic_2_status !== '0' && $sch->pic_2 == Auth::user()->id) {
                        $action = "<p class='text-danger'>Status Sudah Tidak Bisa Dirubah</p>";
                    } else {
                        $action = "<select class='form-control confirm-status' id='confirm-status' data-url='" . $urlconfirm . "' data-id='" . $sch->id . "'> ";
                        if ($status == '0') {
                            $action .= " <option value='0' selected >Dalam Konfirmasi</option>";
                        } else {
                            $action .= " <option value='0' >Dalam Konfirmasi</option>";
                        }
                        if ($status == '1') {
                            $action .= " <option value='1' selected >Setuju</option> ";
                        } else {
                            $action .= " <option value='1' >Setuju</option> ";
                        }
                        if ($status == '2') {
                            $action .= " <option value='2' selected>Tolak</option> ";
                        } else {
                            $action .= " <option value='2' >Tolak</option> ";
                        }
                        $action .= "  </select>";
                    }
                } else {
                    $action = "<a href='$url'><i class='fas fa-edit fa-lg'></i></a> <a style='border: none; background-color:transparent;' class='hapusData' data-id='$sch->id' data-url='$urlHapus'><i class='fas fa-trash fa-lg text-danger'></i></a>";
                }

                if ($sch->surat_dinas) {
                    $surat = '<div class="col-md-4">
                        <a class="btn btn-info btn-sm" target="_BLANK"
                            href="' . asset($sch->surat_dinas) . '">File</a>
                    </div>';
                } else {
                    $surat = 'Surat Belum Diupload';
                }
                if (!empty($pic1->name)) {
                    $pic1Name = $pic1->name;
                } else {
                    $pic1Name = 'N/A';
                }

                if (!empty($pic2->name)) {
                    $pic2Name = $pic2->name;
                } else {
                    $pic2Name = 'N/A';
                }
                if ($sch->status == '1') {
                    $status = '<span class="bg-success badge badge-success" >Terlaksana</span>';
                } else if ($sch->status == '2') {
                    $status = '<span class="bg-danger badge badge-danger" >Terlewati/Batal</span>';
                } else  if ($sch->status == '0') {
                    $status = '<span class="bg-secondary badge badge-gray" >Belum Terlaksana</span>';
                }

                $akunnestedData['no'] = $i + 1;
                $akunnestedData['pic_1'] =  $pic1Name . $statuspic1;
                $akunnestedData['pic_2'] = $pic2Name . $statuspic2;
                $akunnestedData['school'] =  $school[0]->name;
                $akunnestedData['date'] =  $sch->date;
                $akunnestedData['surat_dinas'] =  $surat;
                $akunnestedData['status'] =  $status;
                $akunnestedData['options'] = $action;
                $data_val[] = $akunnestedData;
            }
        }
        $draw_val = $request->input('draw');
        $get_json_data = array(
            "draw"            => intval($draw_val),
            "recordsTotal"    => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data"            => $data_val
        );

        echo json_encode($get_json_data);
    }

    public function ubahschedule($id, Request $request)
    {
        $data['title'] = 'Ubah Data Schedule';
        $data['schedule'] =  ModelsSchedule::findOrFail($id);

        $data['pegawaiAll'] = User::where('role', '=', '6')
            ->get();

        $data['school'] = SchoolDetail::get();
        if ($request->isMethod('post')) {

            $this->validate($request, [
                'school' => 'required',
                'date' => 'required',
                'pic1' => 'required',
                'pic2' => 'required',
                'surat_dinas' => 'file|mimes:pdf|max:1024',
                'description' => 'required',
            ]);
            $img =  $data['schedule']->surat_dinas;
            if ($request->file('surat_dinas')) {
                # delete old img
                if ($img && file_exists(public_path() . $img)) {
                    unlink(public_path() . $img);
                }
                $nama_gambar = time() . '_' . $request->file('surat_dinas')->getClientOriginalName();
                $upload = $request->surat_dinas->storeAs('admin/upload/surat_dinas', $nama_gambar, 'public');
                $img = Storage::url($upload);
                //dd($img);
            }


            $data['schedule']->update([
                'school_id' => $request->school,
                'date' => $request->date,
                'pic_1' => $request->pic1,
                'pic_2' => $request->pic2,
                'surat_dinas' => $img,
                'description' => $request->description,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->route('schedule.index', $data)->with('status', 'Data telah Diubah di database');
        }

        return view('admin.schedule.ubahschedule', $data);
    }

    public function hapusschedule($id)
    {
        $schedule = ModelsSchedule::findOrFail($id);
        if ($schedule->user_image && file_exists(public_path() . $schedule->user_image)) {
            unlink(public_path() . $schedule->user_image);
        }
        $schedule->delete($id);
        return response()->json([
            'msg' => 'Data yang dipilih telah dihapus'
        ]);
    }

    public function ubahconfirmschedule($id)
    {

        $schedule = ModelsSchedule::findOrFail($_POST['id']);

        $checkpic1 =  ModelsSchedule::where('id', $_POST['id'])
            ->where(
                'pic_1',
                Auth::id()
            )->count();
        $checkpic2 =  ModelsSchedule::where('id', $_POST['id'])
            ->where('pic_2', Auth::id())
            ->count();

        if ($checkpic1 > 0) {
            $schedule->update([
                'pic_1_status' => $_POST['idc'],
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            $msg = 'Status Kehadiran Anda Sudah diganti';
        } else if ($checkpic2 > 0) {
            $schedule->update([
                'pic_2_status' => $_POST['idc'],
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            $msg = 'Status Kehadiran Anda Sudah diganti';
        } else {
            $msg = 'error';
        }

        return response()->json([
            'msg' => $msg
        ]);
    }
}
