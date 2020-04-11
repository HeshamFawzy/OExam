<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\user_exam_enroll;

class UserController extends Controller
{
    public function index()
    {
        $options = DB::table('online_exams')->get();

        return view('user.index')->with('options' , $options);
    }

    public function enroll(Request $request)
    {
        $Examiner = DB::table('examiners')->where('user_id' , '=' , auth()->user()->id)->first();

        $NewEnroll = user_exam_enroll::create([
            'examiner_id' => $Examiner->id,
            'exam_id' => $request->input('id'),
            'attendance_status' => 'pending...',
        ]);
        
        return redirect()->back();       
    }
}
