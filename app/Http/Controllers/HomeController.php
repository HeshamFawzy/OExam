<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Admin;

use App\examiner;

class HomeController extends Controller
{
    public function start()
    {
        $BasicAdmin = User::create([
            'name' => 'BasicAdmin',
            'email' => 'BasicAdmin@BasicAdmin.com',
            'password' => bcrypt('123456Aa_'),
            'role' => 'BasicAdmin',
        ]);

        $Admin = User::create([
            'name' => 'Admin',
            'email' => 'Admin@Admin.com',
            'password' => bcrypt('123456Aa_'),
            'role' => 'Admin',
        ]);

        $Admint = Admin::create([
            'user_id' => $Admin->id,
        ]);

        $User = User::create([
            'name' => 'User',
            'email' => 'User@User.com',
            'password' => bcrypt('123456Aa_'),
            'role' => 'User',
        ]);

        $Usert = examiner::create([
            'user_id' => $User->id,
        ]);

        return view('welcome');
    }

    public function verification()
    {
        return view('wait');
    }
}
