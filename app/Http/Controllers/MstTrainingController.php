<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class MstTrainingController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        if(!Session::has('mnuMasterTraining'))
        {
            return view('errors.403');
        }

        else {

            return view('layouts.MstTraining');

        }

    }

    public function listTraining(){

        $result = DB::table('mst_training')
                    ->selectRaw("LTRIM(RTRIM(train_id)) as train_id, LTRIM(RTRIM(descr)) as descr, dt_created, dt_modified, LTRIM(RTRIM(user_id)) as user_id")
                    ->get();

         return \DataTables::of($result)
                ->addColumn('Act', function($data) {

                    return '
                        <a href="javascript:void(0)" data-id="'.$data->train_id.'" class="bs-tooltip editTraining" data-placement="top" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-warning"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </a>  

                        <a href="javascript:void(0)" title="Delete" class="bs-tooltip deleteTraining" data-placement="top" data-id="'.$data->train_id.'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                        </a>';
                    })
                ->rawColumns(['Act'])
                ->make(true);
    }

    public function saveTraining(Request $request){ 

        $userid = Session::get('USERNAME');
        $tr_date = Carbon::now();
        $txtMillID = 'HAPI';
        $txtDtModified = '1900-01-01 00:00:00';
        $txtTrainingID = $request->txtTrainingID;
        if(!$txtTrainingID){
            $txtTrainingID = '';
        }
        $txtDescr = $request->txtDescr;
        if(!$txtDescr){
            $txtDescre = '';
        }

        try {

            $save = DB::table('mst_training')
                    ->insert([
                        'mill_id' => $txtMillID,
                        'train_id' => $txtTrainingID,
                        'descr' => $txtDescr,
                        'dt_created' => $tr_date,
                        'dt_modified' => $txtDtModified,
                        'user_id' => $userid   
                    ]);

            return response()->json(['response' => "Data sukses disimpan"]);
            
        }

        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => $error]);
        }


    }

    public function editTraining(Request $request){

        $txtTrainID = $request->txtTrainID;

        $result = DB::table('mst_training')
                ->selectRaw('LTRIM(RTRIM(train_id)) as train_id, LTRIM(RTRIM(descr)) as descr')
                ->where('member_id', '=', $txtTrainID)
                ->get();

        return response()->json($result);
    }
}
