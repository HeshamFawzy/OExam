<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\user_exam_enroll;

use Illuminate\Support\Facades\Storage;

use File;

use App\Examiner;

use Redirect;

use Illuminate\Pagination\LengthAwarePaginator;

use View;

class UserController extends Controller
{
    public function index()
    {
        $options = DB::table('online_exams')->orderby('created_at' , 'desc')->get();

        $Examiner = DB::table('examiners')->where('user_id' , '=' , auth()->user()->id)->first();

        $Enrolled = DB::table('user_exam_enrolls')
        ->where('examiner_id' , '=' , $Examiner->id)
        ->join('online_exams', 'online_exams.id', '=', 'user_exam_enrolls.exam_id')
        ->get();

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

    public function profile()
    {
        $user = DB::table('users')
        ->join('examiners' , 'examiners.user_id' , '=' , 'users.id')
        ->where('user_id' , '=' , auth()->user()->id)
        ->first();

        return view('user.profile')->with('user' , $user);
    }

    public function updateprofile(Request $request, $id)
    {
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        Storage::disk('public')->put($image->getFilename().'.'.$extension,  File::get($image));

        Examiner::where('examiners.user_id' , '=' , $id)->update([
            'address'               => $request->input('address'),
            'mobile_no'               => $request->input('mobile_no'),
            "mime"                  => $image->getClientMimeType(),
            "original_filename"     => $image->getClientOriginalName(),
            "filename"              => $image->getFilename().'.'.$extension,
        ]);

        return Redirect::route('user');
    }

    public function startexam($exam)
    {
        session()->put('exam', $exam);
        $question = DB::table('questions')
        ->join('online_exams' , 'questions.exam_id' , '=' , 'online_exams.id')
        ->select('questions.*')
        ->where('online_exams.id' , '=' , $exam)
        ->first();

        $result = json_decode(json_encode($question) , true);
        
        $options = DB::table('options')->where('question_id' , '=' , $question->id)->get();
        $result['options'] = $options;

        return view('user.exam')->with('question' , $result);
    }

    public function next($id)
    {
        $exam = session()->get('exam');
        $question = DB::table('questions')
        ->join('online_exams' , 'questions.exam_id' , '=' , 'online_exams.id')
        ->select('questions.*')
        ->where('online_exams.id' , '=' , $exam)
        ->where('questions.id' , '=' , $id + 1)
        ->first();
        if($question != null){
            $result = json_decode(json_encode($question) , true);
        
            $options = DB::table('options')->where('question_id' , '=' , $question->id)->get();
            $result['options'] = $options;

            return View::make('user.exam')->with('question' , $result);
        }
        
        return View::make('user.exam')->withErrors(['IF U Want to finish the test Click Finsh']);

    }

    public function previous($id)
    {
        $exam = session()->get('exam');
        $question = DB::table('questions')
        ->join('online_exams' , 'questions.exam_id' , '=' , 'online_exams.id')
        ->select('questions.*')
        ->where('online_exams.id' , '=' , $exam)
        ->where('questions.id' , '=' , $id - 1)
        ->first();

        if($question != null){
            $result = json_decode(json_encode($question) , true);
        
            $options = DB::table('options')->where('question_id' , '=' , $question->id)->get();
            $result['options'] = $options;

            return View::make('user.exam')->with('question' , $result);
        }

        return View::make('user.exam')->withErrors(['IF U Want to finish the test Click Finsh']);
    }

    public function question(Request $request, $id)
    {
        if($request->input('action') == 'next')
        {
            return $this->next($id);
        } else if($request->input('action') == 'previous')
        {
            return $this->previous($id);
        }
    }
}
