<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class BasicAdminController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->where('role' , 'User')->get();
        return view('basicadmin.index', ['users' => $users]);
    }

    public function verify(Request $request)
    {

    }
}
