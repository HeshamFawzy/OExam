<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Admin;

use App\examiner;

use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    public function start()
    {
        $BasicAdmin = User::create([
            'name' => 'BasicAdmin',
            'email' => 'BasicAdmin@BasicAdmin.com',
            'password' => bcrypt('123456Aa_'),
        ]);

        $Admin = User::create([
            'name' => 'Admin',
            'email' => 'Admin@Admin.com',
            'password' => bcrypt('123456Aa_'),
        ]);

        $Admint = Admin::create([
            'user_id' => $Admin->id,
        ]);

        $User = User::create([
            'name' => 'User',
            'email' => 'User@User.com',
            'password' => bcrypt('123456Aa_'),
        ]);

        $Usert = examiner::create([
            'user_id' => $User->id,
        ]);

        $BasicAdminRole = Role::create(['name' => 'BasicAdmin']);

        $AdminRole = Role::create(['name' => 'Admin']);

        $UserRole = Role::create(['name' => 'User']);

        $UnVerify = Role::create(['name' => 'UnVerify']);

        $BasicAdmin->assignRole('BasicAdmin');

        $Admin->assignRole('Admin');

        $User->assignRole('User');


        return view('welcome');
    }

    public function verification()
    {
        return view('wait');
    }
}
