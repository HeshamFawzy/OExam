<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

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

        $User = User::create([
            'name' => 'User',
            'email' => 'User@User.com',
            'password' => bcrypt('123456Aa_'),
            'role' => 'User',
        ]);

        return view('welcome');
    }

    public function verification()
    {
        return view('wait');
    }
}
