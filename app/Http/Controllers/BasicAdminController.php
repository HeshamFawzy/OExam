<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\User;

use Redirect;

class BasicAdminController extends Controller
{
    
    public function index()
    {
        $users = DB::table('users')
        ->where('role' , 'UnVerify')
        ->orwhere('role' , 'User')
        ->orwhere('role' , 'Admin')
        ->get();

        $options = ['Admin' , 'User', 'UnVerify'];
        return view('basicadmin.index', ['users' => $users , 'options' => $options]);
    }

    public function verify(Request $request)
    {
        User::where('users.id' , '=' , $request->input('id'))->update([
            'role' => $request->input('role'),
        ]);

        return Redirect::route('basicadmin');
    }
}
