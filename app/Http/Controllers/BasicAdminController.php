<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\User;

class BasicAdminController extends Controller
{
    public function index()
    {
        $users = DB::table('users')
        ->where('role' , '')
        ->orwhere('role' , 'User')
        ->orwhere('role' , 'Admin')
        ->get();

        $options = ['Admin' , 'User'];
        return view('basicadmin.index', ['users' => $users , 'options' => $options]);
    }

    public function verify(Request $request)
    {
        User::where('users.id' , '=' , $request->input('id'))->update([
            'role' => 'Admin',
        ]);
    }

    public function unverify(Request $request)
    {
        User::where('users.id' , '=' , $request->input('id'))->update([
            'role' => '',
        ]);
    }
}
