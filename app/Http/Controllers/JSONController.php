<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use DB;

class JSONController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function listIndustrial(){

        $result = DB::table('position')
                ->selectRaw('LTRIM(RTRIM(position_id)) as position_id, LTRIM(RTRIM(position)) as position')
                ->where('mill_id', '=', 'HAPI')
                ->where('active_flag', '=', 'Y')
                ->get();

        return response()->json($result);

    }

    public function getMemberID(){

        $member_id = DB::table('member')
                    ->selectRaw('max(RIGHT(RTRIM(member_id), 7)) + 1 as member_id')
                    ->value('member_id');

        $member_id = str_pad($member_id, 7, '0', STR_PAD_LEFT);

        return response()->json(['member_id' => $member_id]);


    }

    public function getTrainingID(){

        $train_id = DB::table('mst_training')
                    ->selectRaw('max(RIGHT(RTRIM(train_id), 4)) + 1 as train_id')
                    ->value('train_id');

        $train_id = str_pad($train_id, 4, '0', STR_PAD_LEFT);

        return response()->json(['train_id' => $train_id]);


    }
    
    public function getEventID(){

        $dateNow = Carbon::now();
        $date = date("yym", strtotime($dateNow)); 
        $mill = 'HAPI';

        $trx_id = DB::table('event_hdr')
                    ->selectRaw("isnull(right(max(rtrim(trx_id)),3),0) + 1 as trx_id")
                    ->whereRaw("mill_id = '$mill' and left(trx_id,6) = '$date'")
                    ->value('trx_id');

        $trx_id = str_pad($trx_id, 3, '0', STR_PAD_LEFT);
        $event_id = $date.".".$trx_id;


        return response()->json(['eventID' => $event_id]);

    }

    public function listOffice(){

        $result = DB::table('office')
                ->selectRaw('LTRIM(RTRIM(office_id)) as office_id, LTRIM(RTRIM(office_name)) as office_name')
                ->where('mill_id', '=', 'HAPI')
                ->where('active_flag', '=', 'Y')
                ->get();

        return response()->json($result);

    }

    public function listTraining(){

        $result = DB::table('mst_training')
                ->selectRaw('LTRIM(RTRIM(train_id)) as train_id, LTRIM(RTRIM(descr)) as descr')
                ->where('mill_id', '=', 'HAPI')
                ->where('stat', '=', 'Y')
                ->get();

        return response()->json($result);

    }

    public function listTrainingType($id){

        $result = DB::table('mst_type_training')
                ->selectRaw('LTRIM(RTRIM(train_id)) as train_id, LTRIM(RTRIM(train_type_id)) as train_type_id, LTRIM(RTRIM(descr)) as descr')
                ->where('mill_id', '=', 'HAPI')
                ->where('train_id', '=', $id)
                ->where('stat', '=', 'Y')
                ->get();

        return response()->json($result);

    }

    public function listqKota() {

        $result = DB::table('member')
                ->selectRaw('LTRIM(RTRIM(city)) as city')
                ->where('mill_id', '=', 'HAPI')
                ->where('city1', '<>', '')
                ->groupBY('city')
                ->get();

        return response()->json($result);


    }

}
