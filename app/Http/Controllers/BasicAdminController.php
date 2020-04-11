<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\User;

use Redirect;

use App\Admin;

use App\Examiner;

use Spatie\Permission\Models\Role;


class BasicAdminController extends Controller
{
    public function index()
    {
        $users = User::role(['Admin', 'User', 'UnVerify'])
        ->paginate(10);

        $options = ['Admin' , 'User', 'UnVerify'];
        return view('basicadmin.index', ['users' => $users , 'options' => $options]);
    }

    public function verify(Request $request)
    {
        $user = User::where('users.id' , '=' , $request->input('id'))->first();

        $user->syncRoles($request->input('role'));
        
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
