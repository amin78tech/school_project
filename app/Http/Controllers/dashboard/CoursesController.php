<?php

namespace App\Http\Controllers\dashboard;

use App\Events\notifAddStudentInCourse;
use App\Events\notifAddTeacherInCourse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CoursesRegisterRequest;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Register;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Version;

class CoursesController extends Controller
{
    public function getUserGuard()
    {
        $user_login=Auth::user();
        $user_guard=$user_login->roles()->get();
        return $user_guard[0]['guard'];
    }
    public function index()
    {
        $get_data=Course::query()->get();
        $title="Show Course List";
        return view("dashboard.courses.courselist")
            ->with("title",$title)
            ->with("courses",$get_data)
            ->with('guard',$this->getUserGuard());
    }

    public function create()
    {
        // https://laravel.com/docs/8.x/eloquent-relationships#inline-relationship-existence-queries
         $inner_join_teacher=User::query()->join('role_user','users.id','=','role_user.user_id')->where('status',1);
         $get_teacher=$inner_join_teacher->where('role_id',2)->get();
         $inner_join_student=User::query()->join('role_user','users.id','=','role_user.user_id')->where('status',1);
         $get_student=$inner_join_student->where('role_id',3)->get();;
            $title="Course create page";
            return view("dashboard.courses.create")
                ->with("title",$title)
                ->with("teachers",$get_teacher)
                ->with("students",$get_student)
                ->with('guard',$this->getUserGuard());
    }

    public function store(CoursesRegisterRequest $request)
    {
            $get_date=$request->validated();
            $course=new Course();
            $course->title = $get_date['name'];
            $course->start_date = $get_date['startdate'];
            $course->end_date = $get_date['enddate'];
            $course->user_id = $get_date['optionTeacher'];
            $course->save();
            notifAddTeacherInCourse::dispatch($get_date['optionTeacher']);
            foreach ($get_date['optionStudent'] as $item){
                notifAddStudentInCourse::dispatch($item);
                CourseUser::query()->insert([
                    "user_id"=>$item,
                    "course_id"=>$course->id
                ]);
            }
            return redirect()->route("CoursesController.index");
    }

    public function edit($id)
    {
        $get_course=Course::query()->where('id',$id)->first();
        $get_user_course=$get_course->users()->get();
        $get_teacher=$get_course->teacher()->get();
        $title="Course Manage Page";
        return view("dashboard.courses.coursemanage")
            ->with("title",$title)
            ->with("courseId",$id)
            ->with("users",$get_user_course)
            ->with("teacher",$get_teacher)
            ->with('guard',$this->getUserGuard());
    }

    public function destroy($id)
    {
        Course::destroy($id);
        CourseUser::query()->where("course_id",$id)->delete();
        return redirect()->route("CoursesController.index");
    }

    public function deleteUserInCourse($id)
    {
        CourseUser::query()->where("user_id",$id)->delete();
    }
    public function addUserinCourseShow($id)
    {
        $get_course=Course::query()->where('id',$id)->first();
        $get_users=$get_course->users()->get();
        $get_teacher=$get_course->teacher()->first();
        $get_all_id=[];
        if (count($get_users)==1){
            $get_all_id[]=$get_users[0]['id'];
            $get_all_id[]=$get_teacher['id'];
        }else{
            foreach ($get_users as $user){
                $get_all_id[]=$user['id'];
            }
//            $get_all_id[]=$get_teacher['id'];
        }
        $final_user=Role::query()->where('name','student')->first();
        $users=$final_user->users()->get();
        $total=[];
        foreach ($users as $user){
                    $total[]=$user['id'];
        }
        $f=array_diff($total,$get_all_id);
        $t=User::query()->whereIn('id',$f)->get();
        $title="Add Student in Course";
        return view("dashboard.courses.addstudent")
            ->with("title",$title)
            ->with("users",$t)
            ->with("course_id",$id)
            ->with('guard',$this->getUserGuard());
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
        $get_course=Course::query()->where('id',$idCourse)->first();
        $get_teacher=$get_course->teacher()->get();
        $get_teacher_role=Role::query()->get()->where('name','teacher')->first();
        $find_data_teacher=$get_teacher_role->users()->get();
        $final=[];
        foreach ($find_data_teacher as $teacher){
            if ($teacher['id']!=$get_teacher[0]['id']){
                $final[]=$teacher;
            }
        }

        $title="Change Teacher Page";
        return view("dashboard.courses.changeteacher")
            ->with("title",$title)
            ->with("teachers",$final)
            ->with("idCourse",$idCourse)
            ->with('guard',$this->getUserGuard());
    }

    public function changeTeacherStore($id, Request $request)
    {
        Course::where('id', $id)
            ->update([
                "user_id"=>$request["teacher"]
            ]);
    }
}
