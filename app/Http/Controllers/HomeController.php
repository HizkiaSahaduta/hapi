<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;

class HomeController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        $groupid = Session::get('GROUPID');

        if ($groupid) {

            return view('layouts.home');

        }

        else {

            return view('layouts.home_');
        }

        
    }

    public function getDashboard(Request $request) {

        $total = 0;

        $office_id = Session::get('OFFICEID');


        $result1 = DB::select(DB::raw("select
                    case 
                        when st_anggota = 'Anggota Penuh' then 'Anggota Penuh'
                        when st_anggota <> 'Anggota Penuh' then 'Anggota Afiliasi'
                        else null
                    end as tipe_anggota,
                    case 
                        when st_anggota = 'Anggota Penuh' then count(member_id)
                        when st_anggota <> 'Anggota Penuh' then count(member_id)
                        else null
                    end as jml_anggota
                    from member
                    group by st_anggota"));

        foreach ($result1 as $results1) {

            $total = $total + $results1->jml_anggota;

        }

        $result2 = DB::select(DB::raw("select 
                    case
                        when province1 = '' then 'N/A'
                        else ltrim(rtrim(province1))
                    end as province1, count(member_id) as jml_aplikator from member
                    group by province1"));

        $result3_1 = DB::select(DB::raw("select 'Pelatihan&Sertifikasi' as keterangan, 
                    count(case when st_pelatihan = 'Y' and st_bnsp = 'Y' then 1 else null end) as val
                    from member
                    where st_anggota = 'Anggota Penuh'
                    union all
                    select 'Pelatihan' as keterangan,
                    count(case when st_pelatihan = 'Y' and st_bnsp = 'N' then 1 else null end) as val
                    from member
                    where st_anggota = 'Anggota Penuh'
                    union all
                    select 'Sertifikasi' as keterangan,
                    count(case when st_pelatihan = 'N' and st_bnsp = 'Y' then 1 else null end) as val
                    from member
                    where st_anggota = 'Anggota Penuh'
                    union all
                    select 'N/A' as keterangan,
                    count(case when st_pelatihan = 'N' and st_bnsp = 'N' then 1 else null end) as val
                    from member
                    where st_anggota = 'Anggota Penuh'"));

        $result3_2 = DB::select(DB::raw("select 'Pelatihan&Sertifikasi' as keterangan, 
                    count(case when st_pelatihan = 'Y' and st_bnsp = 'Y' then 1 else null end) as val
                    from member
                    where st_anggota <> 'Anggota Penuh'
                    union all
                    select 'Pelatihan' as keterangan,
                    count(case when st_pelatihan = 'Y' and st_bnsp = 'N' then 1 else null end) as val
                    from member
                    where st_anggota <> 'Anggota Penuh'
                    union all
                    select 'Sertifikasi' as keterangan,
                    count(case when st_pelatihan = 'N' and st_bnsp = 'Y' then 1 else null end) as val
                    from member
                    where st_anggota <> 'Anggota Penuh'
                    union all
                    select 'N/A' as keterangan,
                    count(case when st_pelatihan = 'N' and st_bnsp = 'N' then 1 else null end) as val
                    from member
                    where st_anggota <> 'Anggota Penuh'"));

            if ($office_id){

                $result4_1 = DB::select(DB::raw("select Periode, count(trx_id) as val
                            from view_list_trainee where train_id = '01' and office_id = '$office_id'
                            group by Periode"));

                $result4_2 = DB::select(DB::raw("select Periode, count(trx_id) as val
                            from view_list_trainee where train_id = '02' and office_id = '$office_id'
                            group by Periode"));

                $result5_1 = DB::select(DB::raw("select Periode, sum(qty_member) as val
                            from view_list_trainee where train_id = '01' and office_id = '$office_id'
                            group by Periode"));

                $result5_2 = DB::select(DB::raw("select Periode, sum(qty_member) as val
                            from view_list_trainee where train_id = '02' and office_id = '$office_id'
                            group by Periode"));
            }
    
            if (!$office_id){
    
                $result4_1 = DB::select(DB::raw("select Periode, count(trx_id) as val
                            from view_list_trainee where train_id = '01'
                            group by Periode"));

                $result4_2 = DB::select(DB::raw("select Periode, count(trx_id) as val
                            from view_list_trainee where train_id = '02'
                            group by Periode"));

                $result5_1 = DB::select(DB::raw("select Periode, sum(qty_member) as val
                            from view_list_trainee where train_id = '01'
                            group by Periode"));

                $result5_2 = DB::select(DB::raw("select Periode, sum(qty_member) as val
                            from view_list_trainee where train_id = '02'
                            group by Periode"));
            }


        $data = ['total_anggota' => $result1,
        'total' => $total, 
        'anggota_per_wilayah' => $result2, 
        'pelatihan_sertifikasi_penuh' => $result3_1, 
        'pelatihan_sertifikasi_afiliasi' => $result3_2,
        'jml_pelatihan' => $result4_1, 
        'jml_sertifikasi' => $result4_2,
        'peserta_pelatihan' => $result5_1, 
        'peserta_sertifikasi' => $result5_2];

        return response()->json($data);

    }

    public function listTraineePeriodic(Request $request){

        $office_id = Session::get('OFFICEID');

        if ($office_id){

            $where = "where 1=1 and office_id = '$office_id'";
        }

        if (!$office_id){

            $where = "where 1=1";
        }

        $qTrainingID = $request->qTrainingID;
        if ($qTrainingID) {

            $where.= " and train_id = '$qTrainingID'";
        }

        $qPeriode = $request->qPeriode;
        if ($qPeriode) {

            $where.= " and Periode = '$qPeriode'";
        }

        $result = DB::select(DB::raw("select trx_id,
        FORMAT(dt_trx, 'dd.MM.yyyy') as dt_trx, office_name, qty_member, descr_mst_training, descr_mst_training_type, descr_event, remark, agency, address, city,stat,
        FORMAT(dt_created, 'dd.MM.yyyy') as dt_created,
        FORMAT(dt_modified, 'dd.MM.yyyy') as dt_modified,
        user_id from view_list_trainee $where order by dt_trx"));

        return \DataTables::of($result)
            ->editColumn('stat', function ($data) {
                if ($data->stat == "P") return '<span class="shadow-none badge badge-success"> Planned</span>';
                if ($data->stat == "C") return '<span class="shadow-none badge badge-secondary"> Closed</span>';
            })
            ->rawColumns(['stat'])
            ->make(true);
                    

    }

    public function listDtlTraineePeriodic(Request $request){

        $office_id = Session::get('OFFICEID');

        if ($office_id){

            $where = "where 1=1 and office_id = '$office_id'";
        }

        if (!$office_id){

            $where = "where 1=1";
        }

        $qTrainingID = $request->qTrainingID;
        if ($qTrainingID) {

            $where.= " and train_id = '$qTrainingID'";
        }

        $qPeriode = $request->qPeriode;
        if ($qPeriode) {

            $where.= " and Periode = '$qPeriode'";
        }

        $result = DB::select(DB::raw("select trx_id, FORMAT(dt_trx, 'dd.MM.yyyy') as dt_trx, office_name, st_anggota, 
        descr_mst_training, descr_mst_training_type, 
        Periode, member_id, stat, member_name, city_dom, prov_dom, phone 
        from view_dtl_trainee $where order by dt_trx"));

        return \DataTables::of($result)
            ->editColumn('stat', function ($data) {
                if ($data->stat == "P") return '<span class="shadow-none badge badge-success"> Planned</span>';
                if ($data->stat == "L") return '<span class="shadow-none badge badge-primary"> Lulus</span>';
                if ($data->stat == "A") return '<span class="shadow-none badge badge-danger"> Alpha</span>';
                if ($data->stat == "H") return '<span class="shadow-none badge badge-warning"> Hadir</span>';
            })
            ->rawColumns(['stat'])
            ->make(true);
                    

    }

    public function chartDtlTraineePeriodic(Request $request){
        
        $office_id = Session::get('OFFICEID');

        if ($office_id){

            $where = "where 1=1 and office_id = '$office_id'";
        }

        if (!$office_id){

            $where = "where 1=1";
        }

        $qTrainingID = $request->qTrainingID;
        if ($qTrainingID) {

            $where.= " and train_id = '$qTrainingID'";
        }

        $qPeriode = $request->qPeriode;
        if ($qPeriode) {

            $where.= " and Periode = '$qPeriode'";
        }

        $result = DB::select(DB::raw("select st_anggota, count(member_id) as jml_peserta from view_dtl_trainee
                    $where group by periode, st_anggota"));

        return response()->json($result);

    }

    public function chartCityPerProv(Request $request){

        $where = "where 1=1";

        $qProv = $request->qProv;
        if ($qProv) {

            if ($qProv == 'N/A') {

                $where.= " and province1 = ''";

            }

            else {

                $where.= " and province1 like '%$qProv%'";

            }

        }

        $result = DB::select(DB::raw("select 
                case
                        when city1 = '' then 'N/A'
                        else ltrim(rtrim(city1))
                end as city1, count(member_id) as jml_aplikator 
                from member
                $where
                group by city1"));

        return response()->json($result);

    }

    public function getListAnggotaKorda(Request $request)
    {
        $period = $request->period ? $request->period : Carbon::now()->format('Ym');

        $penuh = DB::select(DB::raw("SELECT
                        view_total_anggota_by_korda.st_anggota, 
                        LTRIM(RTRIM(view_total_anggota_by_korda.office_name)) as office_name,
                        SUM(view_total_anggota_by_korda.total_anggota) AS total_anggota
                    FROM
                        view_total_anggota_by_korda
                    WHERE 
                        view_total_anggota_by_korda.periode <= $period AND view_total_anggota_by_korda.st_anggota = 'Anggota Penuh'
                    GROUP BY
                        view_total_anggota_by_korda.st_anggota, 
                        view_total_anggota_by_korda.office_name"));
        
        $afiliasi = DB::select(DB::raw("SELECT
                        view_total_anggota_by_korda.st_anggota, 
                        LTRIM(RTRIM(view_total_anggota_by_korda.office_name)) as office_name,
                        SUM(view_total_anggota_by_korda.total_anggota) AS total_anggota
                    FROM
                        view_total_anggota_by_korda
                    WHERE 
                        view_total_anggota_by_korda.periode <= $period AND view_total_anggota_by_korda.st_anggota = 'Anggota Afiliasi'
                    GROUP BY
                        view_total_anggota_by_korda.st_anggota, 
                        view_total_anggota_by_korda.office_name"));

        
        $data = ['penuh' => $penuh,
            'afiliasi' => $afiliasi
        ];

        return response()->json($data);
    }

    public function getListAnggotaKordaTersertifikasi (Request $request)
    {
        $period = $request->period ? $request->period : Carbon::now()->format('Ym');

        $penuh = DB::select(DB::raw("SELECT
                        view_total_anggota_sertifikasi_korda.st_anggota,
                        view_total_anggota_sertifikasi_korda.city,
                        SUM ( view_total_anggota_sertifikasi_korda.total_anggota ) AS total_anggota 
                    FROM
                        view_total_anggota_sertifikasi_korda 
                    WHERE
                        view_total_anggota_sertifikasi_korda.periode <= $period AND view_total_anggota_sertifikasi_korda.st_anggota = 'Anggota Penuh'
                    GROUP BY
                        view_total_anggota_sertifikasi_korda.st_anggota,
                        view_total_anggota_sertifikasi_korda.city"));
        
        $afiliasi = DB::select(DB::raw("SELECT
                        view_total_anggota_sertifikasi_korda.st_anggota,
                        view_total_anggota_sertifikasi_korda.city,
                        SUM ( view_total_anggota_sertifikasi_korda.total_anggota ) AS total_anggota 
                    FROM
                        view_total_anggota_sertifikasi_korda 
                    WHERE
                        view_total_anggota_sertifikasi_korda.periode <= $period AND view_total_anggota_sertifikasi_korda.st_anggota = 'Anggota Afiliasi'
                    GROUP BY
                        view_total_anggota_sertifikasi_korda.st_anggota,
                        view_total_anggota_sertifikasi_korda.city"));

        
        $data = ['penuh' => $penuh,
            'afiliasi' => $afiliasi
        ];

        return response()->json($data);
    }



    
   

}
