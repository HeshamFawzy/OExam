<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\online_exam;

use App\Admin;

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
        $id = Admin::where('user_id' , auth()->user()->id)->select('id')->get();
        $NewExam = online_exam::create([
            'admin_id' => $id[0]->id,
            'online_exam_title' => $request->input('title'),
            'online_exam_datetime' => $request->input('date'),
            'online_exam_duration' => $request->input('duration'),
            'total_question' => $request->input('total'),
            'marks_per_right_answer' => $request->input('right'),
            'marks_per_wrong_answer' => $request->input('wrong'),
            'online_exam_status' => 'pending...',
        ]);

       return redirect()->action('AdminController@index');
    }
}
