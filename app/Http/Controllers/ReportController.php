<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule as ModelsSchedule;
use App\Models\SchoolDetail;
use App\Models\User;
use App\Models\avgPerbandinganKriteria;
use App\Models\Kriteria;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use PDF;

class ReportController extends Controller
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

        return redirect(route('home'));
    }

    public function schedule(Request $request)
    {

        $data['title'] = 'Laporan Penjadwalan Kunjungan';


        // $data['schedule'] = ModelsSchedule::where('date', 'like', '%' . Carbon::now()->year . '%')->get();
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'fdate' => 'required',
                'udate' => 'required|after_or_equal:fdate',
            ]);


            $data['fdate'] = ModelsSchedule::where('date', 'like', '%' . Carbon::createFromFormat('Y-m-d', $_POST['fdate'])->year . '%')->min('date');
            $data['udate'] = ModelsSchedule::where('date', 'like', '%' . Carbon::createFromFormat('Y-m-d', $_POST['udate'])->year . '%')->max('date');


            if ($data['fdate']) {

                $data['fyear'] = Carbon::createFromFormat('Y-m-d', $_POST['fdate'])->year;
                $data['uyear'] = Carbon::createFromFormat('Y-m-d', $_POST['udate'])->year;
            } else {
                $data['fdate'] = Carbon::now()->format('Y-m-d');
                $data['udate'] = Carbon::now()->format('Y-m-d');
                $data['fyear'] =  Carbon::createFromFormat('Y-m-d', $data['fdate'])->year;
                $data['uyear'] =  Carbon::createFromFormat('Y-m-d', $data['udate'])->year;
            }
        } else {

            $data['fdate'] = ModelsSchedule::where('date', 'like', '%' . Carbon::now()->year . '%')->min('date');
            $data['udate'] = ModelsSchedule::where('date', 'like', '%' . Carbon::now()->year . '%')->max('date');
            if ($data['fdate']) {

                $data['fyear'] = Carbon::createFromFormat('Y-m-d', $data['fdate'])->year;
                $data['uyear'] = Carbon::createFromFormat('Y-m-d', $data['udate'])->year;
            } else {
                $data['fdate'] = Carbon::now()->format('Y-m-d');
                $data['udate'] = Carbon::now()->format('Y-m-d');
                $data['fyear'] =  Carbon::createFromFormat('Y-m-d', $data['fdate'])->year;
                $data['uyear'] =  Carbon::createFromFormat('Y-m-d', $data['udate'])->year;
            }
        }

        return view('admin.report.schedule', $data);
    }
    public function reportschedule(Request $request)
    {

        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
            0 => 'no',
            1 => 'pic_1',
            2 => 'pic_2',
            3 => 'school',
            4 => 'date',
            5 => 'status',
            6 => 'surat_dinas',
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

        $first_date =  $request->fyear . '-01-01';
        $until_date =  $request->uyear . '-12-12';

        if (empty($request->input('search.value'))) {

            if (Auth::user()->role == '6') {
                $schedule_data = ModelsSchedule::whereBetween('date',  [$first_date, $until_date])
                    ->offset($start_val)
                    ->limit($limit_val)
                    ->orderBy($order_val, $dir_val)
                    ->get();
            } else {
                $schedule_data = ModelsSchedule::whereBetween('date',  [$first_date, $until_date])
                    ->offset($start_val)
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
                    ->orderBy($order_val, $dir_val)
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
                    ->get();
                $pic2 =  User::where('id', $sch->pic_2)
                    ->get();
                $school =  SchoolDetail::where('id', $sch->school_id)
                    ->get();
                if ($sch->pic_1_status == '1') {
                    $statuspic1 = '<br/><span class="bg-success badge badge-success" >Accepted</span>';
                } else if ($sch->pic_1_status == '2') {
                    $statuspic1 = '<br/><span class="bg-danger badge badge-danger" >Rejected</span>';
                } else {
                    $statuspic1 = '<br/><span class="bg-secondary badge badge-gray" >On Confirm</span>';
                }
                if ($sch->pic_2_status == '1') {
                    $statuspic2 = '<br/><span class="bg-success badge badge-success" >Accepted</span>';
                } else if ($sch->pic_2_status == '2') {
                    $statuspic2 = '<br/><span class="bg-danger badge badge-danger" >Rejected</span>';
                } else {
                    $statuspic2 = '<br/><span class="bg-secondary badge badge-gray" >On Confirm</span>';
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

                    $action = "<select class='form-control confirm-status' id='confirm-status' data-url='" . $urlconfirm . "' data-id='" . $sch->id . "'> ";
                    if ($status == '0') {
                        $action .= " <option value='0' selected >On Confirm</option>";
                    } else {
                        $action .= " <option value='0' >On Confirm</option>";
                    }
                    if ($status == '1') {
                        $action .= " <option value='1' selected >Accept</option> ";
                    } else {
                        $action .= " <option value='1' >Accept</option> ";
                    }
                    if ($status == '2') {
                        $action .= " <option value='2' selected>Reject</option> ";
                    } else {
                        $action .= " <option value='2' >Reject</option> ";
                    }
                    $action .= "  </select>";
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

                if ($sch->status == '1') {
                    $status = '<span class="bg-success badge badge-success" >Terlaksana</span>';
                } else if ($sch->status == '2') {
                    $status = '<span class="bg-danger badge badge-danger" >Terlewati/Batal</span>';
                } else  if ($sch->status == '0') {
                    $status = '<span class="bg-secondary badge badge-gray" >Belum Terlaksana</span>';
                }
                if (!empty($pic1[0]->name)) {
                    $pic1Name = $pic1[0]->name;
                } else {
                    $pic1Name = 'N/A';
                }

                if (!empty($pic2[0]->name)) {
                    $pic2Name = $pic2[0]->name;
                } else {
                    $pic2Name = 'N/A';
                }
                $akunnestedData['no'] = $i + 1;
                $akunnestedData['pic_1'] =  $pic1Name;
                $akunnestedData['pic_2'] = $pic2Name;
                $akunnestedData['school'] =  $school[0]->name;
                $akunnestedData['date'] =  $sch->date;
                $akunnestedData['status'] =  $status;
                $akunnestedData['surat_dinas'] =  $surat;
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

    public function exportschedule(Request $request)
    {
        $data['title'] = 'Laporan Schedule';
        $data['date'] = date('d-M-Y');
        $first_date = $_GET['fyear'] . '-01-01';
        $until_date = $_GET['uyear'] . '-12-12';
        // retreive all records from db
        $data['schedule'] = ModelsSchedule::whereBetween('date',  [$first_date, $until_date])
            ->with('pic1', 'pic2', 'school')
            ->orderByDesc('date')
            ->get();
        // share data to view
        // view()->share('ModelsSchedule', $data);

        // return view('admin.report.export_schedule', $data);
        $pdf = PDF::loadView('admin.report.export_schedule', $data);

        // // download PDF file with download method
        return $pdf->stream('pdf_file.pdf');
    }


    public function ahp(){
        $data['title'] = 'Perhitungan AHP';
        $data['geomean'] = avgPerbandinganKriteria::with('Kriteria1', 'Kriteria2')->get();
        $data['kriteria'] = Kriteria::get();
        return view('admin.report.ahp', $data);
    }
}
