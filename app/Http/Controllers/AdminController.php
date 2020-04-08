<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\online_exam;

use App\Admin;

use Illuminate\Support\Carbon;

use Redirect;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $online_exams = DB::table('online_exams')->paginate(3);

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

       return Redirect::route('admin');
    }

    public function editexam($id)
    {
        $online_exam = online_exam::where('id', $id)->first();

        return Redirect::back()->with('online_exam' , $online_exam);
    }

    public function editexamp(Request $request, $id)
    {
        online_exam::where('id' , '=' , $id)->update([
            'online_exam_title' => $request->input('title'),
            'online_exam_datetime' => $request->input('date'),
            'online_exam_duration' => $request->input('duration'),
            'total_question' => $request->input('total'),
            'marks_per_right_answer' => $request->input('right'),
            'marks_per_wrong_answer' => $request->input('wrong'),
        ]);

        return Redirect::route('admin');
    }

    public function deleteexam($id)
    {
        $online_exam = online_exam::where('id', $id)->first();
        if($online_exam != null){
            $online_exam->delete();
        }

        return Redirect::route('admin');
    }

    public function timer()
    {
        $now =  Carbon::now('Africa/Cairo')->timestamp;
        $online_exams = DB::table('online_exams')
        ->get();

        foreach($online_exams as $online_exam)
        {
            if($online_exam->online_exam_status == "pending...")
            {
                $datetime = Carbon::createFromFormat('Y-m-d H:i:s',$online_exam->online_exam_datetime, 'Africa/Cairo')->timestamp;
                if($datetime < $now)
                {
                    online_exam::where('online_exams.id' , '=' , $online_exam->id)->update([
                        'online_exam_status' => 'started',
                    ]);
                }
            }      
        }
    }

    public function timer2()
    {
        $online_exams = DB::table('online_exams')
        ->get();
        foreach($online_exams as $online_exam)
        {
            if($online_exam->online_exam_status == "started")
            {
                $now =  Carbon::now('Africa/Cairo')->timestamp;
                $datetime = Carbon::createFromFormat('Y-m-d H:i:s',$online_exam->online_exam_datetime, 'Africa/Cairo')->timestamp;
                $difference = $now - $datetime;
                $duration = (int)$online_exam->online_exam_duration * 60;
                if($difference > $duration)
                {
                    online_exam::where('online_exams.id' , '=' , $online_exam->id)->update([
                        'online_exam_status' => 'completed',
                    ]);
                }
            } 
        }
    }
}
