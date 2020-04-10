<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }

    public function index()
    {
        $options = DB::table('online_exams')->get();

        //DD($options);

        return view('user.index')->with('options' , $options);
    }
}
