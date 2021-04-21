<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Hash;

class ChangePassController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('layouts.ChangePassword');
    }

    public function ActChangePass(Request $request)
    {


        $userid = Session::get('USERNAME');
        $passwd = Session::get('PASSWORD');

        $currentpasswd = $request->input('currentpassword');
        $newpassword = $request->input('newpassword');

        if($passwd == $currentpasswd)
        {

            if($newpassword == null || empty($newpassword)){
                return redirect('ChangePass')->with('alert','Harap isi password baru');
            }
            if($currentpasswd== $newpassword){
                return redirect('ChangePass')->with('alert','Password yang baru tidak boleh sama dengan password yang lama');
            }
            else
            {
                DB::table('sec_user')
                    ->where('user_id2', $userid)
                    ->update(['password' => Hash::make($newpassword), 'user_pass' => $newpassword]);

                Session::put('PASSWORD', $newpassword);
                return redirect('ChangePass')->with('password_changed','Password sukses terganti. Silahkan login lagi.');
            }

        }
        else
        {
            return redirect('ChangePass')->with('alert','Password lama salah');
        }

    }

}
