<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Exports\HapiMemberExport;
use Excel;

class MasterOfficeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        if(!Session::has('mnuMasterOffice'))
        {
            return view('errors.403');
        }

        else {

            return view('layouts.MasterOffice');

        }

    }

    public function listMasterOffice(Request $request)
    {
        $where = "where 1=1";

        $result = DB::select(DB::raw("select 
                                        LTRIM(RTRIM(mill_id)) as mill_id, 
                                        office_id, 
                                        LTRIM(RTRIM(office_name)) as office_name, 
                                        LTRIM(RTRIM(address)) as address, 
                                        LTRIM(RTRIM(city)) as city, 
                                        LTRIM(RTRIM(phone)) as phone, 
                                        LTRIM(RTRIM(fax)) as fax, 
                                        LTRIM(RTRIM(email)) as email, 
                                        LTRIM(RTRIM(active_flag)) as active_flag,
                                        provinsi.id as provinsi_id,
                                        LTRIM(RTRIM(provinsi.nama)) as provinsi
                                    from office 
                                    LEFT JOIN provinsi ON office.id_provinsi = provinsi.id 
                                    $where 
                                    order by 1"));

        return \DataTables::of($result)
                ->editColumn('active_flag', function ($data) {
                    if ($data->active_flag == "Y") return '<span class="shadow-none badge badge-success"> Active</span>';
                    return '<span class="shadow-none badge badge-danger"> N/A</span>';
                })
                ->addColumn('Detail', function($data) {

                    return '
                        <a href="javascript:void(0)" data-id="'.$data->office_id.'" class="bs-tooltip editMember" data-placement="top" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-warning"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </a>                        
                        ';
                })
                ->rawColumns(['Detail','active_flag'])
                ->make(true);

    }

    public function saveDataOffice(Request $request)
    { 
        $userid = Session::get('USERNAME');

        $txtOfficeID = $request->txtOfficeID;
        $txtName = $request->txtName;
        if(!$txtName){
            $txtName = '';
        }
        $txtStatus = $request->txtStatus;
        if(!$txtStatus){
            $txtStatus = '';
        }
        $txtPhone = $request->txtPhone;
        if(!$txtPhone){
            $txtPhone = '';
        }
        $txtFax = $request->txtFax;
        if(!$txtFax){
            $txtFax = '';
        }
        $txtEmail = $request->txtEmail;
        if(!$txtEmail){
            $txtEmail = '';
        }
        $txtProvText = $request->txtProvText;
        if(!$txtProvText){
            $txtProvText = '';
        }
        $txtCity = $request->txtCity;
        if(!$txtCity){
            $txtCity = '';
        }
        $txtAddress = $request->txtAddress;
        if(!$txtAddress){
            $txtAddress = '';
        }

        try {

            $checkID = DB::table('office')
                        ->where('office_id', '=', $txtOfficeID)
                        ->first();

            if ($checkID) {
                $save = DB::table('office')
                        ->where('office_id', '=', $txtOfficeID)
                        ->update([
                            'office_name' => $txtName,
                            'address' => $txtAddress,
                            'city' => $txtCity,
                            'phone' => $txtPhone,
                            'fax' => $txtFax,
                            'email' => $txtEmail,
                            'id_provinsi' => $txtProvText,                            
                            'active_flag' => $txtStatus,
                            'dt_modified' => now(),
                            'user_id' => $userid
                        ]);

                return response()->json(['response' => "Data sukses diperbaharui"]);
            } else{
                $office_id = DB::table('office')
                            ->select('office_id')
                            ->max('office_id');

                $office_id = $office_id + 1;

                $save = DB::table('office')
                        ->insert([
                            'mill_id' => 'HAPI',
                            'office_id' => $office_id, 
                            'office_name' => $txtName,
                            'address' => $txtAddress,
                            'city' => $txtCity,
                            'phone' => $txtPhone,
                            'fax' => $txtFax,
                            'email' => $txtEmail,
                            'id_provinsi' => $txtProvText,                            
                            'active_flag' => $txtStatus,
                            'dt_created' => now(),
                            'user_id' => $userid
                        ]);

                return response()->json(['response' => "Data sukses disimpan"]);
            }

        } catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => $error]);
        }

    }

    public function getDetailOffice(Request $request)
    { 
        $txtOfficeID = $request->txtOfficeID;

        try {

            $result = DB::table('office')
                        ->selectRaw("LTRIM(RTRIM(mill_id)) as mill_id, 
                        office_id,
                        LTRIM(RTRIM(office_name)) as office_name,
                        LTRIM(RTRIM(address)) as address,
                        LTRIM(RTRIM(city)) as city,
                        LTRIM(RTRIM(phone)) as phone,
                        LTRIM(RTRIM(fax)) as fax,
                        LTRIM(RTRIM(email)) as email,
                        LTRIM(RTRIM(active_flag)) as active_flag,
                        id_provinsi
                        ")
                        ->where('office_id', '=', $txtOfficeID)
                        ->first();

            return response()->json($result);
        }

        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => $error]);
        }
    }
}
