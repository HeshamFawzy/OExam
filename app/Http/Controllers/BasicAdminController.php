<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\User;

use Redirect;

use App\Admin;

USE App\Examiner;

class BasicAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('basicadmin');
    }

    public function index()
    {
        $users = DB::table('users')
        ->where('role' , 'UnVerify')
        ->orwhere('role' , 'User')
        ->orwhere('role' , 'Admin')
        ->paginate(10);;

        $options = ['Admin' , 'User', 'UnVerify'];
        return view('basicadmin.index', ['users' => $users , 'options' => $options]);
    }

    public function verify(Request $request)
    {
        $user = User::where('users.id' , '=' , $request->input('id'))->update([
            'role' => $request->input('role'),
        ]);
        $user = User::where('users.id' , '=' , $request->input('id'))->get();
        if($request->input('role') == "Admin"){
            $existA = Admin::where('user_id' , $request->input('id'))->get();
            if($existA->isEmpty()){
                $Admin = Admin::create([
                    'user_id' => $user[0]->id
                ]);
            }
            $this->existE($request);
        }elseif($request->input('role') == "User"){
            $existE = Examiner::where('user_id' , $request->input('id'))->get();
            if($existE->isEmpty()){
                $Examiner = Examiner::create([
                    'user_id' => $user[0]->id
                ]);
            }
            $this->existA($request);
        } else {
            $this->existA($request);
            $this->existE($request);
        }

        return Redirect::route('basicadmin');
    }

    public function existA($request){
        $existA = Admin::where('user_id' , $request->input('id'))->get();
        if($existA->count() > 0){
            DB::table('admins')->where('user_id', $request->input('id'))->delete();
        }
    }

    public function existE($request){
        $existE = Examiner::where('user_id' , $request->input('id'))->get();
            if($existE->count() > 0){
                DB::table('examiners')->where('user_id', $request->input('id'))->delete();
            }
    }

    public function search(Request $request)
    {
        $users = DB::table('users')
        ->where('users.email', 'like' , '%'.$request->input('search').'%')
        ->paginate(10);;

        $options = ['Admin' , 'User', 'UnVerify'];
        return view('basicadmin.index', ['users' => $users , 'options' => $options]);
    }
}
