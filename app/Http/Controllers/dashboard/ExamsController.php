<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddQuestionInExamRequest;
use App\Http\Requests\FormAddExamRequest;
use App\Http\Requests\FormUpdateExamRequest;
use App\Models\Bank;
use App\Models\BankExam;
use App\Models\Banks;
use App\Models\Course;
use App\Models\Descriptives;
use App\Models\Exam;
use App\Models\Test;
use Carbon\Carbon;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use phpDocumentor\Reflection\PseudoTypes\PositiveInteger;
use PHPUnit\Framework\Constraint\Count;

class ExamsController extends Controller
{
    public function showTeacherCourse()
    {
         $teacher_id=auth()->user()->id;
         $teacher_course=Course::query()->where('user_id',$teacher_id)->get();
         $title='Teacher Course Page';
         return view('dashboard.exams.courselist')
             ->with('title',$title)
             ->with('courses',$teacher_course);
    }
    public function showExams($id)
    {
         $get_exams=Exam::query()->where('course_id',$id)->get();
         $title='Exams List Page';
         return view('dashboard.exams.examslist')
             ->with('title',$title)
             ->with('exams',$get_exams)
             ->with('course_id',$id);
    }

    public function addExamShow($id)
    {
        $title='Create Exam Pages';
        return view('dashboard.exams.addExamShow')
            ->with('title',$title)
            ->with('course_id',$id);
    }

    public function addExamStore($id,FormAddExamRequest $request)
    {
        $get_data=$request->validated();
        $name=$get_data['title'];
        $time=intval($get_data['time']);
        $start_date_time=$get_data['startDate']." ".$get_data['startTime'];
        $end_time=$get_data['startDate'].' '.$get_data['endTime'];
        Exam::query()->insert([
            'course_id'=>$id,
            'name'=>$get_data['title'],
            'time'=>$request['time'],
            'start_date'=>$start_date_time,
            'end_time'=>$end_time
        ]);
    }
    public function editExamShow($id)
    {
         $get_exam=Exam::query()->where('id',$id)->get();
         $tafkik_start_date_time=explode(' ',$get_exam[0]['start_date']);
         $tafkik_end_date_time=explode(' ',$get_exam[0]['end_time']);
         $title='Edit Exam Page';
         return view('dashboard.exams.editExamShow')
             ->with('title',$title)
             ->with('exam',$get_exam)
             ->with('startDate',$tafkik_start_date_time['0'])
             ->with('startTime',$tafkik_start_date_time['1'])
             ->with('endTime',$tafkik_end_date_time['1']);
    }

    public function editExamStore($id,FormUpdateExamRequest $request)
    {
        $get_data=$request->validated();
        $start_date_time=$get_data['startDate']." ".$get_data['StartTime'];
        $end_time=$get_data['startDate']." ".$get_data['EndTime'];
        Exam::query()->where('id',$id)->update([
            'name'=>$request['title'],
            'time'=>$request['time'],
            'start_date'=>$start_date_time,
            'end_time'=>$end_time
        ]);
    }
    public function dropExam($id)
    {
        Exam::query()->where('id',$id)->delete();
    }

    public function showQuizQuestion($id)
    {
        /** SHOW YOUR QUESTION IN EXAM */
        $get_course=Exam::query()->where('id',$id)->first();
        /** TEST */
        /** get question   */
        $get_question_test=$get_course->questions()->get()->where('type','test');
        /** get id question */
        $id_tests=[];
        foreach ($get_question_test as $item){
             $id_tests[]=$item['id'];
        }
        $get_tests=Test::query()->whereIn('bank_id',$id_tests)->get();
        $get_test_score=BankExam::query()->whereIn('bank_id',$id_tests)->select('score')->get();
        /** DESCRIPTIVES  */
        /** get question   */
        $get_question_descriptives=$get_course->questions()->get()->where('type','descriptive');
        /** get id question */
        $id_descriptives=[];
        foreach ($get_question_descriptives as $item){
            $id_descriptives[]=$item['id'];
        }
        $get_descriptives=Descriptives::query()->whereIn('bank_id',$id_descriptives)->get();
        $get_id_descriptives_table=Descriptives::query()->whereIn('bank_id',$id_descriptives)->select('id')->get();
        $get_descriptives_score=BankExam::query()->whereIn('bank_id',$id_descriptives)->select('score')->get();
        /** SHOW ALL QUESTION EXCEPT id FOR ADD */
        $get_question_test_add=Test::query()->whereNotIn('bank_id', $id_tests)->get();
        $get_question_descriptives_add=Descriptives::query()->whereNotIn('bank_id', $id_descriptives)->get();
        $title='Add Question in Exam';
        return view('dashboard.exams.manageQuestinQuiz')
            ->with('title',$title)
            ->with('test',$get_tests)
            ->with('scoreTest',$get_test_score)
            ->with('descriptives',$get_descriptives)
            ->with('scoreDescriptives',$get_descriptives_score)
            ->with('addTest',$get_question_test_add)
            ->with('addDescriptives',$get_question_descriptives_add)
            ->with('exam_id',$id);
    }

    public function addQuestionsInexam($id,AddQuestionInExamRequest $request)
    {
        foreach ($request['score'] as $item){
            if ($item===null){
                return 'نمره نباید خالی باشد';
            }
        }
        foreach ($request['question'] as $key=>$item){
            BankExam::query()->insert([
               'exam_id'=>$id,
                'bank_id'=>$item,
                'score'=>$request['score'][$key]
            ]);
        }
        return back();
    }
    public function deleteQuestionInExam($id)
    {
        BankExam::query()->where('bank_id',$id)->delete();
        return back();
    }
}
