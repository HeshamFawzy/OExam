<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $online_exams = DB::table('online_exams')->get();

        return view('admin.index', ['online_exams' => $online_exams]);
    }

    public function create(Request $request)
    {
        dd($request);
    }
}
