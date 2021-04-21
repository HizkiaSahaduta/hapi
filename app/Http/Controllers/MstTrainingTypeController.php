<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class MstTrainingTypeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        if(!Session::has('mnuMstTrainingType'))
        {
            return view('errors.403');
        }

        else {

            return view('layouts.MstTrainingType');

        }

    }
}
