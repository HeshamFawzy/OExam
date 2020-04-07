<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\online_exams;

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
        $validatedData = $request->validate([
            'title' => 'required',
            'date' => 'required',
            'duration' => 'required',
            'total' => 'required',
            'right' => 'required',
            'wrong' => 'required',
        ]);

        $NewExam = online_exams::create([
            'admin_id' => auth()->user()->id,
            'title' => $request->input('title'),
            'date' => $request->input('date'),
            'duration' => $request->input('duration'),
            'total' => $request->input('total'),
            'right' => $request->input('right'),
            'wrong' => $request->input('wrong')
        ]);

       return redirect()->action('AdminController@index');
    }
}
