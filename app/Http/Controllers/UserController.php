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

        $Examiner = DB::table('examiners')->where('user_id' , '=' , auth()->user()->id)->first();

        $Enrolled = DB::table('user_exam_enrolls')
        ->where('examiner_id' , '=' , $Examiner->id)
        ->join('online_exams', 'online_exams.id', '=', 'user_exam_enrolls.exam_id')
        ->get();

        //dd($Enrolled);

        return view('user.index')->with('options' , $options)->with('Enrolled' , $Enrolled);
    }

    public function enroll(Request $request)
    {
        $Examiner = DB::table('examiners')->where('user_id' , '=' , auth()->user()->id)->first();
       

        $Exist = DB::table('user_exam_enrolls')
        ->where('examiner_id' , '=' , $Examiner->id)
        ->where('exam_id' , '=' , $request->input('id'))
        ->first();

        if($Exist == null)
        {
            $NewEnroll = user_exam_enroll::create([
                'examiner_id' => $Examiner->id,
                'exam_id' => $request->input('id'),
                'attendance_status' => 'pending...',
            ]);
        }

        $Enrolled = $Exist = DB::table('user_exam_enrolls')
        ->where('examiner_id' , '=' , auth()->user()->id)
        ->get();

        return redirect()->back()->with('Enrolled' , $Enrolled);       
    }
}
