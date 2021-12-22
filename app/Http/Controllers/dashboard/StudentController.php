<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankExam;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Descriptives;
use App\Models\Exam;
use App\Models\Option;
use App\Models\Test;
use Illuminate\Http\Request;

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
        $title='Add Question in Exam';
        $time=Exam::query()->where('id',$id)->select('time')->get();
        return view('dashboard.students.startexam')
            ->with('title',$title)
            ->with('test',$que_test)
            ->with('descriptives',$que_des)
            ->with('exam_id',$id)
            ->with('time',$time[0]['time']);
    }
}
