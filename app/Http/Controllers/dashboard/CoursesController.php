<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CoursesRegisterRequest;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Register;
use App\Models\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Version;

class CoursesController extends Controller
{
    public function index()
    {
        $get_data=Course::query()->get();
        $title="Show Course List";
        return view("dashboard.courses.courselist")
            ->with("title",$title)
            ->with("courses",$get_data);
    }

    public function create()
    {
        $get_teacher=User::query()->where("role","teacher")
        ->where(function ($query){
            $query->where("status",1);
        });
        $get_student=User::query()->where("role","student")
            ->where(function ($query){
                $query->where("status",1);
            });
        $title="Course create page";
        return view("dashboard.courses.create")
            ->with("title",$title)
            ->with("teachers",$get_teacher->get())
            ->with("students",$get_student->get());
    }

    public function store(CoursesRegisterRequest $request)
    {
            $get_date=$request->validated();
            $course=new Course();
            $course->name = $get_date['name'];
            $course->start_date = $get_date['startdate'];
            $course->end_date = $get_date['enddate'];
            $course->user_id = $get_date['optionTeacher'];
            $course->save();
            //register student to course
            foreach ($get_date['optionStudent'] as $item){
                CourseUser::query()->insert([
                    "user_id"=>$item,
                    "course_id"=>$course->id
                ]);
            }
            return redirect()->route("UserController.index");
    }

    public function edit($id)
    {
        $get_course=Course::query()->find($id);
        $get_user_course=$get_course->users()->get();
        $title="Course Manage Page";
        $get_teacher_course=$get_course->user()->get();
        return view("dashboard.courses.coursemanage")
            ->with("title",$title)
            ->with("courseId",$id)
            ->with("users",$get_user_course)
            ->with("teacher",$get_teacher_course);
    }

    public function destroy($id)
    {
        Course::destroy($id);
        CourseUser::query()->where("course_id",$id)->delete();
    }

    public function deleteUserInCourse($id)
    {
        CourseUser::query()->where("user_id",$id)->delete();
    }

    public function addUserinCourseShow($id)
    {
        $cond="student";
        $get_users=User::query()->where("role",$cond)->get();
        $title="Add Student in Course";
        return view("dashboard.courses.addstudent")
            ->with("title",$title)
            ->with("users",$get_users)
            ->with("course_id",$id);
    }
    public function addUserinCourseShowStore($id,Request $request)
    {
        foreach ($request['optionStudent'] as  $item){
            CourseUser::query()->insert([
               "user_id"=>intval($item),
               "course_id"=>$id
            ]);
        }
    }

    public function changeTeacherShow($id,$idCourse)
    {
        $get_teachers=User::query()->where("id","!=",[$id])->where(function ($query){
            $query->where("role","teacher");
        })->get();
        $title="Change Teacher Page";
        return view("dashboard.courses.changeteacher")
            ->with("title",$title)
            ->with("teachers",$get_teachers)
            ->with("idCourse",$idCourse);
    }

    public function changeTeacherStore($id, Request $request)
    {
        Course::where('id', $id)
            ->update([
                "user_id"=>$request["teacher"]
            ]);
    }
}
