<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\online_exam;

use App\Admin;

use Illuminate\Support\Carbon;

use Redirect;

use App\question;

use App\option;


class AdminController extends Controller
{
    public function index()
    {
        $online_exams = DB::table('online_exams')->orderby('created_at' , 'desc')->paginate(3);

        $number = DB::select("SELECT COUNT(questions.id) AS num
        FROM questions
        RIGHT OUTER JOIN online_exams
        ON questions.exam_id = online_exams.id
        GROUP BY online_exams.id
        ORDER BY online_exams.created_at DESC");

        //dd($online_exams);
        return view('admin.index', ['online_exams' => $online_exams, 'number' => $number]);
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

    public function editexamp(Request $request)
    {
        $validatedData = $request->validate([
            'id'    => 'required',
            'title' => 'required',
            'date' => 'required',
            'duration' => 'required',
            'total' => 'required',
            'right' => 'required',
            'wrong' => 'required',
        ]);
        online_exam::where('id' , '=' , $request->input('id'))->update([
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

    public function createquestion(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'title' => 'required',
            'O1' => 'required',
            'O2' => 'required',
            'O3' => 'required',
            'O4' => 'required',
            'Answer' => 'required',
        ]);

        $NewQuestion = question::create([
            'exam_id' => $request->input('id'),
            'question_title' => $request->input('title'),
            'answer_option' => $request->input('Answer'),
        ]);
        
        for($i = 1;$i < 5;$i++){
            $NewOption = option::create([
                'question_id' => $NewQuestion->id,
                'option_number' => $i,
                'option_title' => $request->input("O".$i)
            ]);
        }

        return Redirect::route('admin');
    }

    public function viewquestions($id)
    {
        $questions = DB::table('questions')->where('exam_id' , $id)->get();
        
        return view('admin.questions')->with('questions' , $questions);
    }

    public function editquestionp(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'title' => 'required',
            'O1' => 'required',
            'O2' => 'required',
            'O3' => 'required',
            'O4' => 'required',
            'Answer' => 'required',
        ]);

        question::where('id' , '=' , $request->input('id'))->update([
            'question_title' => $request->input('title'),
            'answer_option' => $request->input('Answer')
        ]);

        option::where('question_id' , '=' , $request->input('id'))->where('option_number' , '=' , 1)->update([
            'option_title' => $request->input('O1'),
        ]);

        option::where('question_id' , '=' , $request->input('id'))->where('option_number' , '=' , 2)->update([
            'option_title' => $request->input('O2'),
        ]);

        option::where('question_id' , '=' , $request->input('id'))->where('option_number' , '=' , 3)->update([
            'option_title' => $request->input('O3'),
        ]);

        option::where('question_id' , '=' , $request->input('id'))->where('option_number' , '=' , 4)->update([
            'option_title' => $request->input('O4'),
        ]);

        return redirect()->back();
    }

    public function deletequestion($id)
    {
        $question = question::where('id', $id)->first();
        if($question != null){
            $question->delete();
        }

        return redirect()->back();
    }

    public function viewenroll($id)
    {
        $Enrolls = DB::table('user_exam_enrolls')
        ->join('examiners' , 'examiners.id' , '=' , 'user_exam_enrolls.examiner_id')
        ->join('users' , 'users.id' , '=' , 'examiners.user_id')
        ->where('exam_id' , '=' , $id)
        ->get();

        //dd($Enrolls);

        return view('admin.enroll')->with('Enrolls' , $Enrolls);
    }

}
