<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Exports\HapiMemberExport;
use Excel;

class MasterPekerjaanController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        if(!Session::has('mnuMasterPekerjaan'))
        {
            return view('errors.403');
        }

        else {

            return view('layouts.MasterPekerjaan');

        }

    }

    public function listMasterPekerjaan(Request $request)
    {
        $where = "where 1=1";

        $result = DB::select(DB::raw("select 
                                    LTRIM(RTRIM(mill_id)) as mill_id, 
                                    LTRIM(RTRIM(id)) as id, 
                                    LTRIM(RTRIM(pekerjaan)) as pekerjaan, 
                                    LTRIM(RTRIM(descr)) as descr, 
                                    LTRIM(RTRIM(active_flag)) as active_flag
                                    from pekerjaan $where order by 2"));
        return \DataTables::of($result)
                ->editColumn('active_flag', function ($data) {
                    if ($data->active_flag == "Y") return '<span class="shadow-none badge badge-success"> Active</span>';
                    return '<span class="shadow-none badge badge-danger"> N/A</span>';
                })
                ->addColumn('Detail', function($data) {

                    return '
                        <a href="javascript:void(0)" data-id="'.$data->id.'" class="bs-tooltip editMember" data-placement="top" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-warning"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </a>                        
                        ';
                })
                ->rawColumns(['Detail','active_flag'])
                ->make(true);

    }

    public function saveDataPekerjaan(Request $request)
    { 
        $userid = Session::get('USERNAME');

        $txtMemberID = $request->txtMemberID;
        $txtName = $request->txtName;
        if(!$txtName){
            $txtName = '';
        }
        $txtStatus = $request->txtStatus;
        if(!$txtStatus){
            $txtStatus = '';
        }

        try {

            $checkID = DB::table('pekerjaan')
                        ->where('id', '=', $txtMemberID)
                        ->first();

            if ($checkID) {
                $save = DB::table('pekerjaan')
                        ->where('id', '=', $txtMemberID)
                        ->update([
                            'pekerjaan' => $txtName,
                            'active_flag' => $txtStatus,
                            'dt_modified' => now(),
                            'user_id' => $userid
                        ]);

                return response()->json(['response' => "Data sukses diperbaharui"]);
            } else{
                $save = DB::table('pekerjaan')
                        ->insert([
                            'mill_id' => 'HAPI',
                            'id' => $txtMemberID, 
                            'pekerjaan' => $txtName,
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

    public function getDetailPekerjaan(Request $request)
    { 
        $txtMemberID = $request->txtMemberID;

        try {

            $result = DB::table('pekerjaan')
                        ->selectRaw("LTRIM(RTRIM(mill_id)) as mill_id, 
                        LTRIM(RTRIM(id)) as id,
                        LTRIM(RTRIM(pekerjaan)) as pekerjaan,
                        LTRIM(RTRIM(active_flag)) as active_flag")
                        ->where('id', '=', $txtMemberID)
                        ->first();

            return response()->json($result);
        }

        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => $error]);
        }
    }
}
