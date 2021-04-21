<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class MemberTraineeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        if(!Session::has('mnuMemberTrainee'))
        {
            return view('errors.403');
        }

        else {

            return view('layouts.MemberTrainee');

        }

    }

    public function listTrainee(Request $request){

        $office_id = Session::get('OFFICEID');

        if ($office_id){

            $where = "where 1=1 and a.office_id = '$office_id'";
        }

        if (!$office_id){

            $where = "where 1=1";
        }


        $qOfficeID = $request->qOfficeID;
        if ($qOfficeID) {

            $where.= " and a.office_id = '$qOfficeID'";
        }

        $qStatus = $request->qStatus;
        if ($qStatus) {

            $where.= " and a.stat ='$qStatus'";

        }

        $qTrainingID = $request->qTrainingID;
        if ($qTrainingID) {
            
            $where.= " and c.train_id = '$qTrainingID'";
        }

        $qTrainingType = $request->qTrainingType;
        if ($qTrainingType) {

            $where.= " and d.train_type_id =  '$qTrainingType'";
        }

        $qStartDate = $request->qStartDate;
        $qEndDate = $request->qEndDate;
        if ($qStartDate && $qEndDate) {

            $where.= " and a.dt_created between '$qStartDate' and '$qEndDate'";

        }

        if ($qStartDate && !$qEndDate) {

            $where.= " and a.dt_created >= '$qStartDate'";

        }

        if (!$qStartDate && $qEndDate) {

            $where.= " and a.dt_created  <= '$qEndDate'";

        }

        $result = DB::select(DB::raw("select LTRIM(RTRIM(a.trx_id)) as trx_id,
        FORMAT(a.dt_trx, 'dd MMM yyyy') as dt_trx,
        LTRIM(RTRIM(b.office_name)) as office_name, 
        LTRIM(RTRIM(c.descr)) as descr_mst_training, 
        LTRIM(RTRIM(d.descr)) as descr_mst_training_type, 
        LTRIM(RTRIM(a.descr)) as descr_event, 
        LTRIM(RTRIM(a.remark)) as remark, 
        LTRIM(RTRIM(a.agency)) as  agency, 
        LTRIM(RTRIM(a.address)) as address, 
        LTRIM(RTRIM(a.city)) as city, 
        (select count(member_id) from event_dtl where trx_id = a.trx_id) as qty_member, 
        LTRIM(RTRIM(a.stat)) as stat, 
        FORMAT(a.dt_created, 'dd MMM yyyy') as dt_created,
        FORMAT(a.dt_modified, 'dd MMM yyyy') as dt_modified,
        LTRIM(RTRIM(a.user_id)) as user_id 
        from event_hdr a 
        inner join office b on a.office_id = b.office_id
        inner join mst_training c on a.train_id = c.train_id
        inner join mst_type_training d on a.train_type_id = d.train_type_id $where"));
                    

         return \DataTables::of($result)
                ->editColumn('stat', function ($data) {
                    if ($data->stat == "P") return '<span class="shadow-none badge badge-success"> Planned</span>';
                    if ($data->stat == "C") return '<span class="shadow-none badge badge-secondary"> Closed</span>';
                })
                ->addColumn('Detail', function($data) {

                    return '
                        <a href="javascript:void(0)" data-id="'.$data->trx_id.'" class="bs-tooltip editEvent" data-placement="top" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-warning"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </a>  
                        ';
                    })
                ->rawColumns(['stat','Detail'])
                ->make(true);

        // echo $where;
    }

    public function listEventDtl(Request $request){

        $txtEventID = $request->txtEventID;

        $result = DB::select(DB::raw("select LTRIM(RTRIM(a.trx_id)) as trx_id, LTRIM(RTRIM(a.member_id)) as member_id,
        LTRIM(RTRIM(a.stat)) as stat, LTRIM(RTRIM(b.member_name)) as member_name,
        LTRIM(RTRIM(b.city)) as city, LTRIM(RTRIM(b.province)) as province, LTRIM(RTRIM(b.phone)) as phone 
        from event_dtl a
        inner join member b on a.member_id = b.member_id where a.trx_id = '$txtEventID' "));
                    
        return \DataTables::of($result)
            ->editColumn('stat', function ($data) {
                if ($data->stat == "P") return '<span class="shadow-none badge badge-success"> Planned</span>';
                if ($data->stat == "L") return '<span class="shadow-none badge badge-primary"> Lulus</span>';
                if ($data->stat == "A") return '<span class="shadow-none badge badge-danger"> Alpha</span>';
                if ($data->stat == "H") return '<span class="shadow-none badge badge-warning"> Hadir</span>';
            })
            ->addColumn('Detail', function($data) {

                return '
                    <a href="javascript:void(0)" data-id1="'.$data->trx_id.'" data-id2="'.$data->member_id.'" data-id3="'.$data->member_name.'" class="bs-tooltip delMemberEvent" data-placement="top" title="Delete">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    </a>  
                    ';
                })
            ->rawColumns(['stat','Detail'])
            ->make(true);
    }

    public function listMemberClosing(Request $request){

        $txtEventID = $request->txtEventID;
    
        $txtTrainingType = $request->type;


        if ($txtTrainingType == "N") {


            $result = DB::select(DB::raw("select case when (a.stat = 'P' and d.stat_train = 'N') then 'HADIR' 
            when a.stat = 'A' then 'ALPHA' 
            when a.stat = 'H' then 'HADIR' end as attent, a.stat, LTRIM(RTRIM(b.member_id)) as member_id,
            LTRIM(RTRIM(b.member_name)) as member_name,
            LTRIM(RTRIM(b.city)) as city, LTRIM(RTRIM(b.province)) as province, LTRIM(RTRIM(b.phone)) as phone from event_dtl a 
            inner join member b on a.member_id = b.member_id inner join event_hdr c on a.trx_id = c.trx_id inner join mst_type_training d
            on c.train_type_id = d.train_type_id
            where a.mill_id = 'HAPI' and a.trx_id = '$txtEventID' "));
                    
            return \DataTables::of($result)
            ->editColumn('stat', function ($data) {
                if ($data->stat == "A") 
                return '
                <select name="ClosingStat" id="ClosingStat">
                    <option value="H-'.$data->member_id.'">Hadir</option>
                    <option value="A-'.$data->member_id.'" selected="selected">Alpha</option>
                </select>';


                if ($data->stat == "H") 
                return '
                <select name="ClosingStat" id="ClosingStat">
                    <option value="H-'.$data->member_id.'" selected="selected">Hadir</option>
                    <option value="A-'.$data->member_id.'">Alpha</option>
                </select>';

                if ($data->stat == "P") 
                return '
                <select name="ClosingStat" id="ClosingStat">
                    <option value="H-'.$data->member_id.'" selected="selected">Hadir</option>
                    <option value="A-'.$data->member_id.'">Alpha</option>
                </select>';

            })
            ->rawColumns(['stat'])
            ->make(true);
            
        }

        else {

            $result = DB::select(DB::raw("select case when (a.stat = 'P' and d.stat_train = 'N') then 'HADIR' 
            when (a.stat = 'P' and d.stat_train = 'Y') then 'LULUS'
            when a.stat = 'A' then 'ALPHA' 
            when a.stat = 'L' then 'LULUS' 
            when a.stat = 'H' then 'HADIR' end as attent, a.stat, LTRIM(RTRIM(b.member_id)) as member_id,
            LTRIM(RTRIM(b.member_name)) as member_name,
            LTRIM(RTRIM(b.city)) as city, LTRIM(RTRIM(b.province)) as province, LTRIM(RTRIM(b.phone)) as phone from event_dtl a 
            inner join member b on a.member_id = b.member_id inner join event_hdr c on a.trx_id = c.trx_id inner join mst_type_training d
            on c.train_type_id = d.train_type_id
            where a.mill_id = 'HAPI' and a.trx_id = '$txtEventID' "));
                    
            return \DataTables::of($result)
            ->editColumn('stat', function ($data) {
                if ($data->stat == "A") 
                return '
                <select name="ClosingStat" id="ClosingStat">
                    <option value="L-'.$data->member_id.'">Lulus</option>
                    <option value="H-'.$data->member_id.'">Hadir</option>
                    <option value="A-'.$data->member_id.'" selected="selected">Alpha</option>
                </select>';

                if ($data->stat == "L") 
                return '
                <select name="ClosingStat" id="ClosingStat">
                    <option value="L-'.$data->member_id.'" selected="selected">Lulus</option>
                    <option value="H-'.$data->member_id.'">Hadir</option>
                    <option value="A-'.$data->member_id.'">Alpha</option>
                </select>';

                if ($data->stat == "H") 
                return '
                <select name="ClosingStat" id="ClosingStat">
                    <option value="L-'.$data->member_id.'">Lulus</option>
                    <option value="H-'.$data->member_id.'" selected="selected">Hadir</option>
                    <option value="A-'.$data->member_id.'">Alpha</option>
                </select>';

                if ($data->stat == "P") 
                return '
                <select name="ClosingStat" id="ClosingStat">
                    <option value="L-'.$data->member_id.'" selected="selected">Lulus</option>
                    <option value="H-'.$data->member_id.'">Hadir</option>
                    <option value="A-'.$data->member_id.'">Alpha</option>
                </select>';

            })
            ->rawColumns(['stat'])
            ->make(true);

        }

           


        
    }

    public function checkEventHdr($id){

        $result = DB::table('event_hdr')
                ->selectRaw('LTRIM(RTRIM(train_id)) as train_id, LTRIM(RTRIM(train_type_id)) as train_type_id, LTRIM(RTRIM(trx_id)) as trx_id')
                ->where('trx_id', '=', $id)
                ->get();

        return response()->json($result);

    }

    public function saveEventHdr(Request $request){ 

        $userid = Session::get('USERNAME');
        $tr_date = Carbon::now();
        $txtMillID = 'HAPI';
        //$txtActiveFlag = 'Y';
        $txtDtModified = '1900-01-01 00:00:00';

        $txtEventID = $request->txtEventID;
        if (!$txtEventID) {
            $txtEventID = '';
        }
        $txtDtTrx = $request->txtDtTrx;
        if (!$txtDtTrx) {
            $txtDtTrx = '';
        }
        $txtOfficeID = $request->txtOfficeID;
        if (!$txtOfficeID) {
            $txtOfficeID = '';
        }
        $txtTrainingID = $request->txtTrainingID;
        if (!$txtTrainingID) {
            $txtTrainingID = '';
        }
        $txtTrainingType = $request->txtTrainingType;
        if (!$txtTrainingType) {
            $txtTrainingType = '';
        }
        $txtEventName = $request->txtEventName;
        if (!$txtEventName) {
            $txtEventName = '';
        }
        $txtAddress = $request->txtAddress;
        if (!$txtAddress) {
            $txtAddress = '';
        }
        $txtCity = $request->txtCity;
        if (!$txtCity) {
            $txtCity = '';
        }
        $txtProv = $request->txtProv;
        if (!$txtProv) {
            $txtProv = '';
        }
        $txtRemark = $request->txtRemark;
        if (!$txtRemark) {
            $txtRemark = '';
        }
        $txtAgency = $request->txtAgency;
        if (!$txtAgency) {
            $txtAgency = '';
        }

        try {


            $checkID = DB::table('event_hdr')
                        ->where('mill_id', '=', $txtMillID)
                        ->where('trx_id', '=', $txtEventID)
                        ->first();

            $checkQtyMember = DB::table('event_dtl')
                        ->selectRaw('count(member_id) as qty_member')
                        ->where('mill_id', '=', $txtMillID)
                        ->where('trx_id', '=', $txtEventID)
                        ->value('qty_member');

            if (!$checkQtyMember) {
                $checkQtyMember = 0;
            }

            if ($checkID) {                

                $save = DB::table('event_hdr')
                        ->where('mill_id', '=', $txtMillID)
                        ->where('trx_id', '=', $txtEventID)
                        ->update([
                            'office_id' => $txtOfficeID,
                            'train_id' => $txtTrainingID,
                            'train_type_id' => $txtTrainingType,
                            'dt_trx' => $txtDtTrx,
                            'descr' =>	$txtEventName,
                            'remark' =>	$txtRemark,
                            'agency' =>	$txtAgency,
                            'address' => $txtAddress,	
                            'city' => $txtCity,
                            'prov' => $txtProv,
                            'qty_member' =>	$checkQtyMember,
                            'dt_modified' => $tr_date,
                            'user_id' => $userid

                        ]);

                    return response()->json(['response' => "Data sukses diperbaharui"]);
            }

            else {

                $save = DB::table('event_hdr')
                        ->insert([
                            'mill_id' => $txtMillID,
                            'office_id' => $txtOfficeID,
                            'train_id' => $txtTrainingID,
                            'train_type_id' => $txtTrainingType,
                            'trx_id' => $txtEventID,
                            'dt_trx' => $txtDtTrx,
                            'descr' =>	$txtEventName,
                            'remark' =>	$txtRemark,
                            'agency' =>	$txtAgency,
                            'address' => $txtAddress,	
                            'city' => $txtCity,
                            'prov' => $txtProv,
                            'qty_member' =>	$checkQtyMember,
                            'stat' => 'P',
                            'dt_created' => $tr_date,
                            'dt_modified' => $txtDtModified,
                            'user_id' => $userid

                        ]);

                    return response()->json(['response' => "Data sukses disimpan"]);

            }
                    
        }

        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => $error]);
        }



    }

    public function getEventHdr(Request $request) {

        $txtEventID = $request->txtEventID;

        $result = DB::table('event_hdr')
                ->where('trx_id', '=', $txtEventID)
                ->get();

        return response()->json($result);



    }

    public function getQtyEventMember(Request $request) {

        $txtEventID = $request->txtEventID;

        $qty = DB::table('event_dtl')
                ->selectRaw('count(member_id) as qty')
                ->where('trx_id', '=', $txtEventID)
                ->value('qty');

        return response()->json(['response' => $qty]);


    }

    public function getAvailMember(Request $request) {

        $qTrainingID = $request->qTrainingID;
        $qTrainingType = $request->qTrainingType;
        $qEventID = $request->qEventID;

        $result = DB::select(DB::raw("with x (member_id, dt_expired) as 
        (select member_id, max(dateadd(year,ISNULL(year_expired, 0), isnull(dt_finish, getdate()))) as dt_expired from event_closing where 
        train_id = '$qTrainingID' and train_type_id = '$qTrainingType' group by member_id)
        select LTRIM(RTRIM(a.member_id)) as member_id, LTRIM(RTRIM(a.ident_id)) as ident_id,
        CONCAT(LTRIM(RTRIM(a.member_id)), '-', '$qEventID') as id,
        LTRIM(RTRIM(a.member_name)) as nama, LTRIM(RTRIM(a.address)) as alamat_ktp, LTRIM(RTRIM(a.city)) as kota_ktp, LTRIM(RTRIM(a.province)) as provinsi_ktp, 
        LTRIM(RTRIM(a.address1)) as alamat_dom, LTRIM(RTRIM(a.city1)) as kota_dom, LTRIM(RTRIM(a.province1)) as provinsi_dom,
        LTRIM(RTRIM(a.sex)) as jenis_kelamin, LTRIM(RTRIM(a.phone)) as phone, LTRIM(RTRIM(a.last_educ)) as pendidikan, LTRIM(RTRIM(a.job)) as job, LTRIM(RTRIM(a.position)) as position,
        isnull(x.dt_expired, getdate()) as dt_expired from member a left outer join x on a.member_id = x.member_id where a.active_flag = 'Y' and isnull(x.dt_expired, getdate()) <= getdate()
        and a.member_id not in (select member_id from event_dtl where trx_id = '$qEventID')"));
                    

         return \DataTables::of($result)
                ->make(true);
  


    }

    public function saveEventDtl(Request $request){ 


        $userid = Session::get('USERNAME');
        $tr_date = Carbon::now();
        $txtMillID = 'HAPI';
        $txtDtModified = '1900-01-01 00:00:00';

        $id = $request->id;

        $txtEventID = $request->txtEventID;

        $separated = explode(',', $id);

        foreach ($separated as $value) {
            
            try {

                $save = DB::table('event_dtl')
                        ->insert([
                            'mill_id' => $txtMillID,
                            'trx_id' => $txtEventID,
                            'member_id' => $value,
                            'stat' => 'P',
                            'dt_created' => $tr_date,
                            'dt_modified' => $txtDtModified,
                            'user_id' => $userid

                        ]);

            }
            catch(QueryException $ex){
                $error = $ex->getMessage();
                return response()->json(['response' => $error]);
            }
    
        }

        return response()->json(['response' => "Data sukses disimpan"]);
       
        



    }

    public function deleteMemberEvent(Request $request){ 


        $txtEventID =  $request->txtEventID;
        $txtMemberID =  $request->txtMemberID;

        try {

            $delMemberEvent = DB::table('event_dtl')
                            ->where('trx_id', '=', $txtEventID)
                            ->where('member_id', '=', $txtMemberID)
                            ->delete();

            return response()->json(['response' => "Peserta berhasil dihapus dari event"]);

        }
          
        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => $error]);
        }


        
       
        



    }

    public function checkTypeTraining(Request $request){

        $qTrainingID =  $request->qTrainingID;
        $qTrainingType =  $request->qTrainingType;


        $value = DB::table('mst_type_training')
                ->selectRaw('LTRIM(RTRIM(stat_train)) as stat_train')
                ->where('train_id', '=', $qTrainingID)
                ->where('train_type_id', '=', $qTrainingType)
                ->value('stat_train');

        return response()->json(['response' => $value]);



    }

    public function saveEventClosing(Request $request){

        $userid = Session::get('USERNAME');
        $tr_date = Carbon::now();
        $txtMillID = 'HAPI';
        $txtDtModified = '1900-01-01 00:00:00';

        $txtlistMemberClosing = $request->txtlistMemberClosing;
        $txtlistTrainingID = $request->txtlistTrainingID;
        $txtlistTrainingType = $request->txtlistTrainingType;
        $txtEventID = $request->txtEventID;
        $txtTypeEvent = $request->txtTypeEvent;
        $txtDtFinish = $request->txtDtFinish;
        $txtYearExpired = $request->txtYearExpired;
        $txtDtExpired = $request->txtDtExpired;

        $temp1_txtlistMemberClosing = explode(',', $txtlistMemberClosing);


        foreach ($temp1_txtlistMemberClosing as $txtlistMemberClosing1) {


            $txtMemberID = substr($txtlistMemberClosing1, 2);

            $txtStatus = $txtlistMemberClosing1[0];

            if ($txtTypeEvent == "Y") {

                try {


                    $updateEventDtl = DB::table('event_dtl')
                                    ->where('mill_id', '=', $txtMillID)
                                    ->where('trx_id', '=', $txtEventID)
                                    ->where('member_id', '=', $txtMemberID)
                                    ->update([
                                        'stat' => $txtStatus,
                                        'dt_modified' => $tr_date,
                                        'user_id' => $userid

                                    ]);

                    $updateEventHdr = DB::table('event_hdr')
                                    ->where('mill_id', '=', $txtMillID)
                                    ->where('trx_id', '=', $txtEventID)
                                    ->where('train_id', '=' ,$txtlistTrainingID)
                                    ->where('train_type_id', '=', $txtlistTrainingType)
                                    ->update([
                                        'stat' => "C",
                                        'dt_modified' => $tr_date,
                                        'user_id' => $userid
            
                                    ]);

                    $checkEventClosing = DB::table('event_closing')
                                        ->select('trx_id')
                                        ->where('trx_id', '=', $txtEventID)
                                        ->where('member_id', '=', $txtMemberID)
                                        ->value('trx_id');

                    if (!$checkEventClosing) {

                        if ($txtStatus == "L") {

                            $insertEventClosing = DB::table('event_closing')
                                                ->insert([
                                                    'mill_id' => $txtMillID,
                                                    'train_id' => $txtlistTrainingID,
                                                    'train_type_id' => $txtlistTrainingType,
                                                    'trx_id' => $txtEventID,
                                                    'member_id' => $txtMemberID,
                                                    'dt_finish' => $txtDtFinish,
                                                    'year_expired' => $txtYearExpired,
                                                    'dt_expired' => $txtDtExpired,
                                                    'dt_created' => $tr_date,
                                                    'dt_modified' => $txtDtModified,
                                                    'user_id' => $userid

                                                ]);

                        }
                    }

                    else {

                        if ($txtStatus == "L") {

                            $updateEventClosing = DB::table('event_closing')
                                                ->where('mill_id', '=', $txtMillID)
                                                ->where('trx_id', '=', $txtEventID)
                                                ->where('member_id', '=', $txtMemberID)
                                                ->update([
                                                    'dt_finish' => $txtDtFinish,
                                                    'year_expired' => $txtYearExpired,
                                                    'dt_expired' => $txtDtExpired,
                                                    'dt_modified' => $tr_date,
                                                    'user_id' => $userid

                                                ]);

                        }
                        else {

                            $deleteEventClosing = DB::table('event_closing')
                                                ->where('mill_id', '=', $txtMillID)
                                                ->where('trx_id', '=', $txtEventID)
                                                ->where('member_id', '=', $txtMemberID)
                                                ->delete();

                        }


                    }
    
                }
                catch(QueryException $ex){
                    $error = $ex->getMessage();
                    return response()->json(['error' => $error]);
                }


            }

            else {

                try {
            
                    $updateEventDtl = DB::table('event_dtl')
                            ->where('mill_id', '=', $txtMillID)
                            ->where('trx_id', '=', $txtEventID)
                            ->where('member_id', '=', $txtMemberID)
                            ->update([
                                'stat' => $txtStatus,
                                'dt_modified' => $tr_date,
                                'user_id' => $userid
    
                            ]);

                    $updateEventHdr = DB::table('event_hdr')
                            ->where('mill_id', '=', $txtMillID)
                            ->where('trx_id', '=', $txtEventID)
                            ->where('train_id', '=' ,$txtlistTrainingID)
                            ->where('train_type_id', '=', $txtlistTrainingType)
                            ->update([
                                'stat' => "C",
                                'dt_modified' => $tr_date,
                                'user_id' => $userid
    
                            ]);

                                
    
                }
                catch(QueryException $ex){
                    $error = $ex->getMessage();
                    return response()->json(['error' => $error]);
                }
    
            }


          
    
        }




    }

    public function getExpiredDate(Request $request){

        $txtlistTrainingID = $request->txtlistTrainingID;
        $txtlistTrainingType = $request->txtlistTrainingType;
        $txtEventID = $request->txtEventID;

       
        $result = DB::select(DB::raw("select dt_finish, year_expired, dt_expired from event_closing where train_id = '$txtlistTrainingID' and train_type_id = '$txtlistTrainingType' and trx_id = '$txtEventID'
        group by dt_finish, year_expired, dt_expired"));

        return response()->json($result);
        

    }






}
