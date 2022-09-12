<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Exports\HapiMemberExport;
use Excel;

class MemberMgtController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        if(!Session::has('mnuMemberMgt'))
        {
            return view('errors.403');
        }

        else {

            return view('layouts.MemberMgt');

        }

    }

    public function listMember(Request $request){

        $groupid = Session::get('GROUPID');

        $where = "where 1=1";

        $qTipeAnggota = $request->qTipeAnggota;
        if ($qTipeAnggota) {

            $where.= " and st_anggota = '$qTipeAnggota'";
        }

        $qStatus = $request->qStatus;
        if ($qStatus) {

            $where.= " and active_flag = '$qStatus'";
        }

        $qProv = $request->qProv;
        if ($qProv) {

            if ($qProv == 'N/A') {

                $where.= " and province1 = ''";

            }

            else {

                $where.= " and province1 like '%$qProv%'";

            }

        }

        $qTrainee = $request->qTrainee;
        if ($qTrainee) {

            if ($qTrainee == 'Pelatihan&Sertifikasi') {

                $where.= "  and st_pelatihan = 'Y' and st_bnsp = 'Y'";
            
            }

            if ($qTrainee == 'Pelatihan') {

                $where.= " and st_pelatihan = 'Y' and st_bnsp = 'N'";

            } 

            if ($qTrainee == 'Sertifikasi') {

                $where.= " and st_pelatihan = 'N' and st_bnsp = 'Y'";
            
            } 

            if ($qTrainee == 'N/A') {

                $where.= " and st_pelatihan = 'N' and st_bnsp = 'N'";
            
            } 


        }
        
        $qKota = $request->qKota;
        if ($qKota) {

            $where.= " and city1 like '%$qKota%'";

        }

        $qMemberID = $request->qMemberID;
        if ($qMemberID) {
            
            $where.= " and member_id like '%$qMemberID%'";
        }

        $qNama = $request->qNama;
        if ($qNama) {

            $where.= " and member_name like '%$qNama%'";
        }

        $qStartDate = $request->qStartDate;
        $qEndDate = $request->qEndDate;
        if ($qStartDate && $qEndDate) {

            $where.= " and dt_created between '$qStartDate' and '$qEndDate'";

        }

        if ($qStartDate && !$qEndDate) {

            $where.= " and dt_created >= '$qStartDate'";

        }

        if (!$qStartDate && $qEndDate) {

            $where.= " and dt_created  <= '$qEndDate'";

        }

        // echo $where;


        $result = DB::select(DB::raw("select 
                                    dt_created as dt_created1, 
                                    LTRIM(RTRIM(member_id)) as member_id, 
                                    LTRIM(RTRIM(st_anggota)) as st_anggota, 
                                    LTRIM(RTRIM(member_name)) as member_name, 
                                    LTRIM(RTRIM(province)) as province, 
                                    LTRIM(RTRIM(city)) as city,
                                    LTRIM(RTRIM(province1)) as province1, 
                                    LTRIM(RTRIM(city1)) as city1, 
                                    LTRIM(RTRIM(active_flag)) as active_flag, 
                                    FORMAT(dt_created, 'yyyy.MM.dd') as dt_created,
                                    st_pelatihan, st_bnsp
                                    from member $where order by 1"));

        if ($groupid == 'ADMIN' || $groupid == 'DEVELOPMENT') {

            return \DataTables::of($result)
            ->editColumn('active_flag', function ($data) {
                if ($data->active_flag == "Y") return '<span class="shadow-none badge badge-success"> Active</span>';
                return '<span class="shadow-none badge badge-danger"> N/A</span>';
            })
            ->editColumn('st_pelatihan', function ($data) {
                if ($data->st_pelatihan == "Y") return '<span class="shadow-none badge badge-success"> Yes</span>';
                return '<span class="shadow-none badge badge-danger"> No</span>';
            })
            ->editColumn('st_bnsp', function ($data) {
                if ($data->st_bnsp == "Y") return '<span class="shadow-none badge badge-success"> Yes</span>';
                return '<span class="shadow-none badge badge-danger"> No</span>';
            })
            ->addColumn('Detail', function($data) {

                return '
                    <a href="javascript:void(0)" data-id="'.$data->member_id.'" class="bs-tooltip editMember" data-placement="top" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-warning"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    </a>                        
                    ';
                })
            ->editColumn('activate', function ($data) {
                if ($data->active_flag == "Y") 
                return 
                '<label class="switch s-success">
                    <input type="checkbox" class="setActive" id="'.$data->member_id.'" checked value="'.$data->member_id.'">
                    <span class="slider round"></span>
                </label> ';
                if ($data->active_flag == "N") 
                return 
                '<label class="switch s-success">
                    <input type="checkbox" class="setActive" id="'.$data->member_id.'" value="'.$data->member_id.'">
                    <span class="slider round"></span>
                </label>';
            })
            ->rawColumns(['Detail','active_flag', 'activate', 'st_pelatihan', 'st_bnsp'])
            ->make(true);

        }

        else {

            return \DataTables::of($result)
            ->editColumn('active_flag', function ($data) {
                if ($data->active_flag == "Y") return '<span class="shadow-none badge badge-success"> Active</span>';
                return '<span class="shadow-none badge badge-danger"> N/A</span>';
            })
            ->editColumn('st_pelatihan', function ($data) {
                if ($data->st_pelatihan == "Y") return '<span class="shadow-none badge badge-success"> Yes</span>';
                return '<span class="shadow-none badge badge-danger"> No</span>';
            })
            ->editColumn('st_bnsp', function ($data) {
                if ($data->st_bnsp == "Y") return '<span class="shadow-none badge badge-success"> Yes</span>';
                return '<span class="shadow-none badge badge-danger"> No</span>';
            })
            ->rawColumns(['active_flag', 'st_pelatihan', 'st_bnsp'])
            ->make(true);

        }

        
}

    public function saveDataMember(Request $request){ 

        $userid = Session::get('USERNAME');
        //  $tr_date = now();
        $tr_date = now();
        $txtMillID = 'HAPI';
        $txtActiveFlag = 'Y';
        $txtCountries = 'Indonesia';
        $txtDtModified = '1900-01-01 00:00:00';
        $txtMemberID = $request->txtMemberID;
        if(!$txtMemberID){
            $txtMemberID = '';
        }
        $txtName = $request->txtName;
        if(!$txtName){
            $txtName = '';
        }
        $txtNoIDCard = $request->txtNoIDCard;
        if(!$txtNoIDCard){
            $txtNoIDCard = '';
        }
        $txtGender = $request->txtGender;
        if(!$txtGender){
            $txtNoIDCard = '';
        }
        $txtAddress = $request->txtAddress;
        if(!$txtAddress){
            $txtAddress = '';
        }   
        $txtProv = $request->txtProvText;
        if(!$txtProv){
            $txtProv = '';
        }
        $txtCity = $request->txtCity;
        if(!$txtCity){
            $txtCity = '';
        }
        $txtAddressDom = $request->txtAddressDom;
        if(!$txtAddressDom){
            $txtAddressDom = '';
        }
        $txtProvDom = $request->txtProvDomText;
        if(!$txtProvDom){
            $txtProvDom = '';
        }
        $txtCityDom = $request->txtCityDom;
        if(!$txtCityDom){
            $txtCityDom = '';
        }
        $txtBirthplace = $request->txtBirthplace;
        if(!$txtBirthplace){
            $txtBirthplace = '';
        }
        $txtDOB = $request->txtDOB;
        if(!$txtDOB){
            $txtDOB = '1900-01-01 00:00:00';
        }
        $txtDtCreated = $request->txtDtCreated;
        if(!$txtDtCreated){
            $txtDtCreated = '1900-01-01 00:00:00';
        }
        $txtPhone = $request->txtPhone;
        if(!$txtPhone){
            $txtPhone = '';
        }
        $txtEmail = $request->txtEmail;
        if(!$txtEmail){
            $txtEmail = '';
        }
        $txtEducation = $request->txtEducation;
        if(!$txtEducation){
            $txtEducation = '';
        }
        $txtJob = $request->txtJob;
        if(!$txtJob){
            $txtJob = '';
        }
        $txtJabatan = $request->txtJabatan;
        if(!$txtJabatan){
            $txtJabatan = '';
        }
        $txtStatMember = $request->txtStatMember;
        if(!$txtStatMember) {
            $txtStatMember = '';
        }
        $txtIndustrial = $request->txtIndustrial;
        if(!$txtIndustrial){
            $txtIndustrial = '';
        }
        $txtIndustrialName = $request->txtIndustrialName;
        if(!$txtIndustrialName){
            $txtIndustrialName = '';
        }
        $txtStatKartu = $request->txtStatKartu;
        if(!$txtStatKartu){
            $txtStatKartu = 'N';
        }
        else{
            $txtStatKartu = 'Y';
        }
        $txtStatTrainee = $request->txtStatTrainee;
        if(!$txtStatTrainee){
            $txtStatTrainee = 'N';
        }
        else{
            $txtStatTrainee = 'Y';
        }
        $txtStatCert = $request->txtStatCert;
        if(!$txtStatCert){
            $txtStatCert = 'N';
        }
        else{
            $txtStatCert = 'Y';
        }

        $txtOfficeID = $request->txtOfficeID;
        if(!$txtOfficeID){
            $txtOfficeID = null;
        }

        try {


            $checkID = DB::table('member')
                        ->where('member_id', '=', $txtMemberID)
                        ->where('ident_id', '=', $txtNoIDCard)
                        ->first();

            if ($checkID) {
                // return response()->json(['response' => 'No.KTP/No.SIM/Kartu Pelajar dengan nomor '.$txtNoIDCard.' sudah terdaftarkan dengan ID Anggota '.$checkID]);

                $txtPhoto = $request->file('txtPhoto');
                if ($txtPhoto) {

                    $txtPhotoName = $txtMemberID.'.' . $txtPhoto->extension();
                    \File::delete(public_path('img/memberPhotos/' .$txtPhotoName));
                    $txtPhoto->move(public_path('img/memberPhotos/'), $txtPhotoName);
                    $insertPhoto = 'img/memberPhotos/'.$txtPhotoName;

                }
                else {

                    $insertPhoto = DB::table('member')
                            ->selectRaw('LTRIM(RTRIM(pic_url)) as pic_url')
                            ->where('member_id', '=', $txtMemberID)
                            ->where('ident_id', '=', $txtNoIDCard)
                            ->value('pic_url');

                    $insertPhoto = $insertPhoto;
                }

                $save = DB::table('member')
                        ->where('member_id', '=', $txtMemberID)
                        ->where('ident_id', '=', $txtNoIDCard)
                        ->update([
                            'mill_id' => $txtMillID,
                            'member_id' => $txtMemberID,
                            'ident_id' => $txtNoIDCard,
                            'member_name' => $txtName,
                            'address' => $txtAddress,
                            'address1' => $txtAddressDom,
                            'city' =>  $txtCity,
                            'city1' => $txtCityDom,
                            'province' => $txtProv,
                            'province1' => $txtProvDom,
                            'country' => $txtCountries,
                            'birth_place' => $txtBirthplace,
                            'date_birth' => $txtDOB,
                            'sex' => $txtGender,
                            'phone' => $txtPhone,
                            'email' => $txtEmail,
                            'last_educ' => $txtEducation,
                            'job' => $txtJob,
                            'position' =>  $txtJabatan,
                            'pic_url' => $insertPhoto,
                            'active_flag' => $txtActiveFlag,
                            'st_anggota' => $txtStatMember,
                            'position_id' => $txtIndustrial,
                            'position_name' => $txtIndustrialName,
                            'st_kartu' => $txtStatKartu,
                            'st_pelatihan' => $txtStatTrainee,
                            'st_bnsp' => $txtStatCert,
                            'dt_created' => $txtDtCreated,
                            'dt_modifield' => $txtDtModified,
                            'user_id' => $userid,
                            'korda' => $txtOfficeID  
                        ]);

                    return response()->json(['response' => "Data sukses diperbaharui", 'img' => $insertPhoto]);
            }

            else {

                $txtPhoto = $request->file('txtPhoto');
                if ($txtPhoto) {

                    $txtPhotoName = $txtMemberID.'.' . $txtPhoto->extension();
                    \File::delete(public_path('img/memberPhotos/' .$txtPhotoName));
                    $txtPhoto->move(public_path('img/memberPhotos/'), $txtPhotoName);
                    $insertPhoto = 'img/memberPhotos/'.$txtPhotoName;

                }
                else {
                    
                    $txtPhotoName = '';
                    $insertPhoto = $txtPhotoName;
                }

                $save = DB::table('member')
                        ->insert([
                            'mill_id' => $txtMillID,
                            'member_id' => $txtMemberID,
                            'ident_id' => $txtNoIDCard,
                            'member_name' => $txtName,
                            'address' => $txtAddress,
                            'address1' => $txtAddressDom,
                            'city' =>  $txtCity,
                            'city1' => $txtCityDom,
                            'province' => $txtProv,
                            'province1' => $txtProvDom,
                            'country' => $txtCountries,
                            'birth_place' => $txtBirthplace,
                            'date_birth' => $txtDOB,
                            'sex' => $txtGender,
                            'phone' => $txtPhone,
                            'email' => $txtEmail,
                            'last_educ' => $txtEducation,
                            'job' => $txtJob,
                            'position' =>  $txtJabatan,
                            'pic_url' => $insertPhoto,
                            'active_flag' => $txtActiveFlag,
                            'st_anggota' => $txtStatMember,
                            'position_id' => $txtIndustrial,
                            'position_name' => $txtIndustrialName,
                            'st_kartu' => $txtStatKartu,
                            'st_pelatihan' => $txtStatTrainee,
                            'st_bnsp' => $txtStatCert,
                            'dt_created' => $txtDtCreated,
                            'dt_modifield' => $txtDtModified,
                            'user_id' => $userid, 
                            'korda' => $txtOfficeID  
                        ]);

                    return response()->json(['response' => "Data sukses disimpan", 'img' => $insertPhoto]);

            }
                    
        }

        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => $error]);
        }


    }

    public function saveMemberCert(Request $request){ 

        $userid = Session::get('USERNAME');
         $tr_date = now();
        $txtMillID = 'HAPI';
        $txtActiveFlag = 'Y';
        $txtMemberID = $request->txtMemberIDTmp;
        $txtCertName = $request->txtCertName;
        $txtTrainingGround = $request->txtTrainingGround;
        $txtTrainingYear = $request->txtTrainingYear;
        $txtOrganizer = $request->txtOrganizer;
        $txtCert = $request->file('txtCert');

        try {

            $seqNum = DB::table('member_training')
                        ->select('num_id')
                        ->where('member_id', '=', $txtMemberID)
                        ->max('num_id');
            

            $checkMemberID = DB::table('member_training')
                        ->where('member_id', '=', $txtMemberID)
                        ->first();


            if (!$checkMemberID) {

                $txtPhotoName = $txtMemberID.'_'.$txtCertName.'_'.$txtTrainingYear.'_1_'.'.' . $txtCert->extension();
                $txtCert->move(public_path('img/memberCert/'), $txtPhotoName);
                $insertPhoto = 'img/memberCert/'.$txtPhotoName;

                $save = DB::table('member_training')
                        ->insert([
                            'mill_id' => $txtMillID,
                            'member_id' => $txtMemberID,
                            'num_id' => 1,
                            'training_type' => $txtCertName,
                            'training_ground' => $txtTrainingGround,
                            'year' => $txtTrainingYear,
                            'organizer' =>  $txtOrganizer,
                            'pic_url' => $insertPhoto,
                            'dt_created' => $tr_date,
                            'dt_modified' => '1900-01-01 00:00:00',
                            'user_id' => $userid   
                        ]);

                return response()->json(['response' => "Data tersimpan"]);

            }

            else {

                $NumId = $seqNum + 1;
                $txtPhotoName = $txtMemberID.'_'.$txtCertName.'_'.$txtTrainingYear.'_'.$NumId.'_.' . $txtCert->extension();
                $txtCert->move(public_path('img/memberCert/'), $txtPhotoName);
                $insertPhoto = 'img/memberCert/'.$txtPhotoName;


                $save = DB::table('member_training')
                        ->insert([
                            'mill_id' => $txtMillID,
                            'member_id' => $txtMemberID,
                            'num_id' => $NumId,
                            'training_type' => $txtCertName,
                            'training_ground' => $txtTrainingGround,
                            'year' => $txtTrainingYear,
                            'organizer' =>  $txtOrganizer,
                            'pic_url' => $insertPhoto,
                            'dt_created' => $tr_date,
                            'dt_modified' => '1900-01-01 00:00:00',
                            'user_id' => $userid   
                        ]);
                
                return response()->json(['response' => "Data tersimpan"]);

            }                    
                    
        }

        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => $error]);
        }


    }

    public function listCert(Request $request){

        $txtMemberID = $request->id;

        // $txtMemberID = '2019120000021'; 

        $result = DB::table('member_training')
                    ->selectRaw("LTRIM(RTRIM(member_id)) as member_id, num_id, LTRIM(RTRIM(training_type)) as training_type, LTRIM(RTRIM(training_ground)) as training_ground, LTRIM(RTRIM(year)) as year,  LTRIM(RTRIM(organizer)) as organizer")
                    ->where('member_id', '=', $txtMemberID)
                    ->get();

         return \DataTables::of($result)
                ->addColumn('Detail', function($data) {

                    return '
                        <a href="javascript:void(0)" data-id1="'.$data->member_id.'" data-id2="'.$data->num_id.'" class="bs-tooltip editCert" data-placement="top" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-warning"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </a>

                        <a href="javascript:void(0)" data-id1="'.$data->member_id.'" data-id2="'.$data->num_id.'" class="bs-tooltip delCert" data-placement="top" title="Delete">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                        </a>
                        ';
                    })
                ->rawColumns(['Detail'])
                ->make(true);
    }

    public function editCert(Request $request){

        $txtMemberID = $request->txtMemberID;
        $txtNumID = $request->txtNumID;

        $result = DB::table('member_training')
                ->selectRaw('LTRIM(RTRIM(member_id)) as member_id, LTRIM(RTRIM(num_id)) as num_id, LTRIM(RTRIM(training_type)) as training_type, LTRIM(RTRIM(training_ground)) as training_ground, LTRIM(RTRIM(year)) as year, LTRIM(RTRIM(organizer)) as organizer, LTRIM(RTRIM(pic_url)) as pic_url')
                ->where('member_id', '=', $txtMemberID)
                ->where('num_id', '=', $txtNumID)
                ->get();

        return response()->json($result);
       
    }

    public function saveEditMemberCert(Request $request){ 

        $userid = Session::get('USERNAME');
         $tr_date = now();
        $txtMemberID = $request->txtMemberIDTmpEdit;
        $txtNumID = $request->txtNumIDEdit;
        $txtCertName = $request->txtCertNameEdit;
        $txtTrainingGround = $request->txtTrainingGroundEdit;
        $txtTrainingYear = $request->txtTrainingYearEdit;
        $txtOrganizer = $request->txtOrganizerEdit;
        $txtPicURL = $request->txtPicURLEdit;
        $txtCert = $request->file('txtCertEdit');
        
        // echo $txtCert;
        
        if($txtCert) {

            \File::delete(public_path($txtPicURL));
            $txtPhotoName = $txtMemberID.'_'.$txtCertName.'_'.$txtTrainingYear.'_'.$txtNumID.'_.' . $txtCert->extension();
            $txtCert->move(public_path('img/memberCert/'), $txtPhotoName);
            $insertPhoto = 'img/memberCert/'.$txtPhotoName;

        }

        else {

            $insertPhoto = $txtPicURL;

        }

        try {
         
            $save = DB::table('member_training')
                    ->where('member_id', '=', $txtMemberID)
                    ->where('num_id', '=', $txtNumID)
                    ->update([
                        'training_type' => $txtCertName,
                        'training_ground' => $txtTrainingGround,
                        'year' => $txtTrainingYear,
                        'organizer' =>  $txtOrganizer,
                        'pic_url' => $insertPhoto,
                        'dt_modified' => $tr_date,
                        'user_id' => $userid   
                    ]);

            return response()->json(['response' => "Data berhasil diperbarui"]);

        }
        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => $error]);
        }


    }

    public function deleteCert(Request $request){

        $txtMemberID = $request->txtMemberID;
        $txtNumID = $request->txtNumID;

        try {
         
            
            $url = DB::table('member_training')
                    ->selectRaw('LTRIM(RTRIM(pic_url)) as pic_url')
                    ->where('member_id', '=', $txtMemberID)
                    ->where('num_id', '=', $txtNumID)
                    ->value('pic_url');

            if ($url) {

                \File::delete(public_path($url));

                $delete = DB::table('member_training')
                        ->where('member_id', '=', $txtMemberID)
                        ->where('num_id', '=', $txtNumID)
                        ->delete();

                return response()->json(['response' => "Data berhasil dihapus"]);


            }
            else {
                return response()->json(['response' => "File tidak ditemukan"]);
            }
            

        }
        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => $error]);
        }
       
    }

    public function saveKTP(Request $request){

        $txtMemberID = $request->txtMemberIDKTP;
        $txtKTP = $request->file('txtKTP');
        $userid = Session::get('USERNAME');
         $tr_date = now();

        if ($txtKTP) {

            try {

                $urlKTP = DB::table('member')
                        ->selectRaw('LTRIM(RTRIM(ktp_url)) as ktp_url')
                        ->where('member_id', '=', $txtMemberID)
                        ->value('ktp_url');

                if ($urlKTP) {


                    \File::delete(public_path($urlKTP));
                    $txtKTPName = $txtMemberID.'.' . $txtKTP->extension();
                    $txtKTP->move(public_path('img/memberKTP/'), $txtKTPName);
                    $insertPhoto = 'img/memberKTP/'.$txtKTPName;

                    $save = DB::table('member')
                                ->where('member_id', '=', $txtMemberID)
                                ->update([
                                    'ktp_url' => $insertPhoto,
                                    'dt_modifield' => $tr_date,
                                    'user_id' => $userid   
                                ]);

                    $newurlKTP = DB::table('member')
                                ->selectRaw('LTRIM(RTRIM(ktp_url)) as ktp_url')
                                ->where('member_id', '=', $txtMemberID)
                                ->value('ktp_url');

                    return response()->json(['response' => "KTP berhasil disimpan", 'img' => $newurlKTP]);

                }

                else {

                    $txtKTPName = $txtMemberID.'.' . $txtKTP->extension();
                    $txtKTP->move(public_path('img/memberKTP/'), $txtKTPName);
                    $insertPhoto = 'img/memberKTP/'.$txtKTPName;

                    $save = DB::table('member')
                                ->where('member_id', '=', $txtMemberID)
                                ->update([
                                    'ktp_url' => $insertPhoto,
                                    'dt_modifield' => $tr_date,
                                    'user_id' => $userid   
                                ]);

                   $newurlKTP = DB::table('member')
                                ->selectRaw('LTRIM(RTRIM(ktp_url)) as ktp_url')
                                ->where('member_id', '=', $txtMemberID)
                                ->value('ktp_url');

                    return response()->json(['response' => "KTP berhasil disimpan", 'img' => $newurlKTP]);

                }

            }
            catch(QueryException $ex){
                $error = $ex->getMessage();
                return response()->json(['response' => $error]);
            }

        }

        else {

            return response()->json(['response' => "File tidak ditemukan"]);

        }


    }

    public function saveIjazah(Request $request){

        $txtMemberID = $request->txtMemberIDIjazah;
        $txtIjazah = $request->file('txtIjazah');
        $userid = Session::get('USERNAME');
         $tr_date = now();

        if ($txtIjazah) {

            try {

                $urlIjazah = DB::table('member')
                        ->selectRaw('LTRIM(RTRIM(ijasah_url)) as ijasah_url')
                        ->where('member_id', '=', $txtMemberID)
                        ->value('ijasah_url');

                if ($urlIjazah) {


                    \File::delete(public_path($urlIjazah));
                    $txtIjazahName = $txtMemberID.'.' . $txtIjazah->extension();
                    $txtIjazah->move(public_path('img/memberIjazah/'), $txtIjazahName);
                    $insertPhoto = 'img/memberIjazah/'.$txtIjazahName;

                    $save = DB::table('member')
                                ->where('member_id', '=', $txtMemberID)
                                ->update([
                                    'ijasah_url' => $insertPhoto,
                                    'dt_modifield' => $tr_date,
                                    'user_id' => $userid   
                                ]);

                    $newurlIjazah = DB::table('member')
                                ->selectRaw('LTRIM(RTRIM(ijasah_url)) as ijasah_url')
                                ->where('member_id', '=', $txtMemberID)
                                ->value('ijasah_url');

                    return response()->json(['response' => "Ijazah berhasil disimpan", 'img' => $newurlIjazah]);

                }

                else {

                    $txtIjazahName = $txtMemberID.'.' . $txtIjazah->extension();
                    $txtIjazah->move(public_path('img/memberIjazah/'), $txtIjazahName);
                    $insertPhoto = 'img/memberIjazah/'.$txtIjazahName;

                    $save = DB::table('member')
                                ->where('member_id', '=', $txtMemberID)
                                ->update([
                                    'ijasah_url' => $insertPhoto,
                                    'dt_modifield' => $tr_date,
                                    'user_id' => $userid   
                                ]);

                    $newurlIjazah = DB::table('member')
                                ->selectRaw('LTRIM(RTRIM(ijasah_url)) as ijasah_url')
                                ->where('member_id', '=', $txtMemberID)
                                ->value('ijasah_url');

                    return response()->json(['response' => "Ijazah berhasil disimpan", 'img' => $newurlIjazah]);


                }



            }
            catch(QueryException $ex){
                $error = $ex->getMessage();
                return response()->json(['response' => $error]);
            }

        }

        else {

            return response()->json(['response' => "File tidak ditemukan"]);

        }

        
    }

    public function deleteKTP(Request $request){

        $userid = Session::get('USERNAME');
         $tr_date = now();
        $txtMemberID = $request->txtMemberID;

        try {
         
            
            $url = DB::table('member')
                    ->selectRaw('LTRIM(RTRIM(ktp_url)) as ktp_url')
                    ->where('member_id', '=', $txtMemberID)
                    ->value('ktp_url');

            if ($url) {

                \File::delete(public_path($url));

                $update = DB::table('member')
                        ->where('member_id', '=', $txtMemberID)
                        ->update([
                            'ktp_url' => '',
                            'dt_modifield' => $tr_date,
                            'user_id' => $userid   
                        ]);
                        

                return response()->json(['response' => "KTP berhasil dihapus"]);


            }
            else {
                return response()->json(['response' => "File tidak ditemukan"]);
            }
            

        }
        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => $error]);
        }

    }

    public function deleteIjazah(Request $request){

        $userid = Session::get('USERNAME');
         $tr_date = now();
        $txtMemberID = $request->txtMemberID;

        try {
         
            
            $url = DB::table('member')
                    ->selectRaw('LTRIM(RTRIM(ijasah_url)) as ijasah_url')
                    ->where('member_id', '=', $txtMemberID)
                    ->value('ijasah_url');

            if ($url) {

                \File::delete(public_path($url));

                $update = DB::table('member')
                        ->where('member_id', '=', $txtMemberID)
                        ->update([
                            'ijasah_url' => '',
                            'dt_modifield' => $tr_date,
                            'user_id' => $userid   
                        ]);
                        

                return response()->json(['response' => "Ijazah berhasil dihapus"]);


            }
            else {
                return response()->json(['response' => "File tidak ditemukan"]);
            }
            

        }
        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => $error]);
        }
        
    }

    public function getDetailMember(Request $request){ 

        $txtMemberID = $request->txtMemberID;

        try {

            $result = DB::table('member')
                        ->selectRaw("LTRIM(RTRIM(member_id)) as member_id, 
                        LTRIM(RTRIM(ident_id)) as ident_id,
                        LTRIM(RTRIM(member_name)) as member_name,
                        LTRIM(RTRIM(address)) as address,
                        LTRIM(RTRIM(address1)) as address1,
                        LTRIM(RTRIM(city)) as city,
                        LTRIM(RTRIM(city1)) as city1,
                        LTRIM(RTRIM(province)) as province,
                        LTRIM(RTRIM(province1)) as province1,
                        LTRIM(RTRIM(birth_place)) as birth_place,
                        date_birth,
                        dt_created,
                        LTRIM(RTRIM(sex)) as sex,
                        LTRIM(RTRIM(phone)) as phone,
                        LTRIM(RTRIM(email)) as email,
                        LTRIM(RTRIM(last_educ)) as last_educ,
                        LTRIM(RTRIM(job)) as job,
                        LTRIM(RTRIM(position)) as position,
                        LTRIM(RTRIM(pic_url)) as pic_url,
                        LTRIM(RTRIM(ktp_url)) as ktp_url,
                        LTRIM(RTRIM(ijasah_url)) as ijasah_url,
                        LTRIM(RTRIM(st_anggota)) as st_anggota,
                        LTRIM(RTRIM(position_id)) as position_id,
                        LTRIM(RTRIM(position_name)) as position_name,
                        LTRIM(RTRIM(st_kartu)) as st_kartu,
                        LTRIM(RTRIM(st_pelatihan)) as st_pelatihan,
                        LTRIM(RTRIM(st_bnsp)) as st_bnsp,
                        korda")
                        ->where('member_id', '=', $txtMemberID)
                        ->get();

            return response()->json($result);
        }

        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => $error]);
        }


    }

    public function setActive(Request $request){

        $txtMemberID = $request->txtMemberID;
        $txtSetActive = $request->txtSetActive;
        $userid = Session::get('USERNAME');
         $tr_date = now();


        if ($txtSetActive == "Y") {


            try {

                $update = DB::table('member')
                        ->where('member_id', '=', $txtMemberID)
                        ->update([
                            'active_flag' => $txtSetActive,
                            'dt_modifield' => $tr_date,
                            'user_id' => $userid   
                        ]);

                return response()->json(['response' => "Member sukses diaktifkan"]);

            }

            catch(QueryException $ex){
                $error = $ex->getMessage();
                return response()->json(['response' => $error]);
            }

            
        }

        if ($txtSetActive == "N") {

            try {

                $update = DB::table('member')
                        ->where('member_id', '=', $txtMemberID)
                        ->update([
                            'active_flag' => $txtSetActive,
                            'dt_modifield' => $tr_date,
                            'user_id' => $userid   
                        ]);

                return response()->json(['response' => "Member sukses dinonaktifkan"]);

            }


            catch(QueryException $ex){
                $error = $ex->getMessage();
                return response()->json(['response' => $error]);
            }

        }
       
    }

    public function member_to_excel(Request $request) {

        if($request->qTipeAnggota) {
            $qTipeAnggota = $request->qTipeAnggota;
        }
        else {
            $qTipeAnggota = '';
        }

        if($request->qStatus) {
            $qStatus = $request->qStatus;
        }
        else {
            $qStatus = '';
        }

        if($request->qTrainee) {
            $qTrainee = $request->qTrainee;
        }
        else {
            $qTrainee = '';
        }
        
        if($request->qProv){
            $qProv = $request->qProv;
        }
        else {
            $qProv = '';
        }
        
        if($request->qKota){
            $qKota = $request->qKota;
        }
        else {
            $qKota = '';
        }
        
        if($request->qMemberID){
            $qMemberID = $request->qMemberID;
        }
        else{
            $qMemberID = '';
        }
       
        if($request->qNama){
            $qNama = $request->qNama;
        }
        else{
            $qNama = '';
        }
       
        if($request->qStartDate) {
            $qStartDate = $request->qStartDate;
        }
        else{
            $qStartDate = '';
        }
      
        if($request->qEndDate){
            $qEndDate = $request->qEndDate;
        }
        else{
            $qEndDate = '';
        }
    
        return Excel::download(new HapiMemberExport($qTipeAnggota, $qStatus, $qTrainee, $qProv, $qKota, $qMemberID, $qNama, $qStartDate, $qEndDate), 'MemberHAPIReport.xlsx');
        
    }


}
