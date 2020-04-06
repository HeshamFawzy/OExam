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
        ->where('role' , 'User')
        ->get();
        return view('basicadmin.index', ['users' => $users]);
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
            'role' => 'User',
        ]);
    }
}
