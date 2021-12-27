<?php

namespace App\Http\Controllers\dashboard;

use App\Events\notifAddStudentInCourse;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankExam;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Descriptives;
use App\Models\Exam;
use App\Models\Option;
use App\Models\Respon;
use App\Models\Startexam;
use App\Models\Test;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function showStudentCourse()
    {
        $student_id=auth()->user();
        $student_course=$student_id->courses()->get();
        $title='Student Course Page';
        return view('dashboard.students.courselist')
            ->with('title',$title)
            ->with('courses',$student_course);
    }

    public function showExamsCourse($id)
    {
        $get_exams=Exam::query()->where('course_id',$id)->get();
        $title='Exams List Page';
        return view('dashboard.students.examslist')
            ->with('title',$title)
            ->with('exams',$get_exams)
            ->with('course_id',$id);
    }

    public function showQuestionInExam($id)
    {
        $get_bank_id=BankExam::query()->where('exam_id',$id)->select('bank_id')->get();
        $arr_bank_id=[];
        foreach ($get_bank_id as $item){
            $arr_bank_id[]=$item['bank_id'];
        }
        $get_id_in_bank=Bank::query()->whereIn('id',$arr_bank_id)->get();
        /** Slice question(test,des) */
        $arr_test=[];
        $arr_des=[];
        foreach ($get_id_in_bank as $item){
            if ($item['type']=='test'){
                $arr_test[]=$item['id'];
            }else{
                $arr_des[]=$item['id'];
            }
        }
        $que_test=Test::query()->whereIn('bank_id',$arr_test)->get();
        $que_des=Descriptives::query()->whereIn('bank_id',$arr_des)->get();
        $user_id=auth()->user()->id;
        $exam_time=Exam::query()->where('id',$id)->select('time')->get();
        $exam_time_update=Startexam::query()->where('exam_num',$id)->where('user_id',Auth::user()->id)->select('time')->get();
        $set_start_exam=Startexam::query()->where('user_id',$user_id)->where('exam_num',$id)->get();
        if (count($set_start_exam)==0){
            Startexam::query()->insert([
                'user_id'=>Auth::user()->id,
               'exam_num' => $id,
                'time'=>$exam_time[0]['time'],
                'created_at'=> now(),
            ]);
        }
        $title='Add Question in Exam';
        return view('dashboard.students.startexam')
            ->with('title',$title)
            ->with('test',$que_test)
            ->with('descriptives',$que_des)
            ->with('exam_id',$id)
            ->with('time',$exam_time_update[0]['time']);
    }
    public function storeQuestionInExam(Request $request,$exam_id,$student_id)
    {
        if (!is_null($request->question)){
            $is_respone_for_ques=Respon::query()->where('bank_id',$request->question[0])->where('exam_id',$exam_id)->get();
            if (count($is_respone_for_ques)==0){
                foreach ($request->testAns as $key=>$item){
                    Respon::query()->insert([
                        'user_id'=>Auth::user()->id,
                        'bank_id'=>$request->question[$key],
                        'respon'=>$item,
                        'exam_id'=>$exam_id,
                        'created_at'=>now(),
                        'score'=>1
                    ]);
                }
                return back();
            }else{
                foreach ($is_respone_for_ques as $item){
                    $item->delete();
                }
                foreach ($request->testAns as $key=>$item){
                    Respon::query()->insert([
                        'user_id'=>Auth::user()->id,
                        'bank_id'=>$request->question[$key],
                        'respon'=>$item,
                        'exam_id'=>$exam_id,
                        'created_at'=>now(),
                        'score'=>1
                    ]);
                }
                return back();
            }
        }else{
            return back();
        }

    }

    public function storeQuestionInExamDes(Request $request,$exam_id,$student_id)
    {
        $is_respone_for_ques=Respon::query()->where('bank_id',$request->question[0])->where('exam_id',$exam_id)->get();
        if (count($is_respone_for_ques)==0){
                Respon::query()->insert([
                    'user_id'=>Auth::user()->id,
                    'bank_id'=>intval($request->question),
                    'respon'=>$request->desAns[0],
                    'exam_id'=>$exam_id,
                    'created_at'=>now(),
                    'score'=>1
                ]);
                return back();
        }else{
                $is_respone_for_ques[0]->delete();
                Respon::query()->insert([
                    'user_id'=>Auth::user()->id,
                    'bank_id'=>intval($request->question),
                    'respon'=>$request->desAns[0],
                    'exam_id'=>$exam_id,
                    'created_at'=>now(),
                    'score'=>1
                ]);
                return back();
        }
    }
    public function downExam($id)
    {
        Startexam::query()->where('exam_num',$id)->where('user_id',Auth::user()->id)->update([
           'status'=>0
        ]);
        return redirect('/overview');
    }
    public function setTime($user_id,$exam_id,$time)
    {
       Startexam::query()->where('user_id',$user_id)->where('exam_num',$exam_id)->update([
            'time'=>$time,
        ]);
    }
}
