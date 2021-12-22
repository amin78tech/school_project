<?php
use Illuminate\Support\Facades\Route;
//Root Route
Route::get('/',function (){
    return redirect()->route('UserLoginController.show');
});
//Route Overview
Route::get("/overview",[\App\Http\Controllers\OverviewController::class,'show'])->name("OverviewController.show")->middleware('auth:admin,teacher,student');
//Route logout
Route::get('/logout',[\App\Http\Controllers\UserLogoutController::class,'logout'])->name('logout');
//Auth
Route::get("/register",[\App\Http\Controllers\UserRegisterController::class,"create"])->name("UserRegisterController.create");
Route::post("/register",[\App\Http\Controllers\UserRegisterController::class,"store"])->name("UserRegisterController.store");
Route::get('/login',[\App\Http\Controllers\UserLoginController::class,"show"])->name('UserLoginController.show');
Route::post("/login",[\App\Http\Controllers\UserLoginController::class,"store"])->name("UserLoginController.store");
//Users Route
Route::group(['prefix'=>'/users','middleware'=>'auth:admin,teacher,student'],function (){
    Route::get("/list",[\App\Http\Controllers\dashboard\UsersController::class,"index"])->name("UserController.index");
    Route::put("/update/status/{id}",[\App\Http\Controllers\dashboard\UsersController::class,"updateStatus"])->name("UserController.updateStatus");
    Route::get("/update/profile/{id}",[\App\Http\Controllers\dashboard\UsersController::class,"edit"])->name("UserController.edit");
    Route::post("/update/profile/{id}",[\App\Http\Controllers\dashboard\UsersController::class,"update"])->name("UserController.update");
    Route::delete("/delete/{id}",[\App\Http\Controllers\dashboard\UsersController::class,"destroy"])->name("UserController.destroy");
    Route::post("/search",[\App\Http\Controllers\dashboard\UsersController::class,"show"])->name("UsersController.show");
});
//Course Route
Route::group(['prefix'=>'/courses','middleware'=>'auth:admin,teacher,student'],function (){
    Route::get("/list",[\App\Http\Controllers\dashboard\CoursesController::class,"index"])->name("CoursesController.index");
    Route::get("/create",[\App\Http\Controllers\dashboard\CoursesController::class,"create"])->name("CourseController.create");
    Route::post("/create",[\App\Http\Controllers\dashboard\CoursesController::class,"store"])->name("CourseController.store");
    Route::delete("/delete/{id}",[\App\Http\Controllers\dashboard\CoursesController::class,"destroy"])->name("CoursesController.destroy");
    Route::get("/manage/{id}",[\App\Http\Controllers\dashboard\CoursesController::class,"edit"])->name("CoursesController.edit");
    Route::delete("/delete/user/{id}",[\App\Http\Controllers\dashboard\CoursesController::class,"deleteUserInCourse"])->name("CoursesController.deleteUser");
    Route::post("/add/user/course/{id}",[\App\Http\Controllers\dashboard\CoursesController::class,"addUserinCourseShow"])->name("CoursesController.addUser");
    Route::post("/add/user/course/final/{id}",[\App\Http\Controllers\dashboard\CoursesController::class,"addUserinCourseShowStore"])->name("CoursesController.addUserStore");
    Route::post("/change/teacher/show/{id}/{idCourse}",[\App\Http\Controllers\dashboard\CoursesController::class,"changeTeacherShow"])->name("CoursesController.show");
    Route::post("/change/teacher/update/{id}",[\App\Http\Controllers\dashboard\CoursesController::class,"changeTeacherStore"])->name("CoursesController.store");
});
//Question Route
Route::group(['prefix'=>'/questions','middleware'=>'auth:admin,teacher,student'],function (){
    Route::get('/create/descriptive',[\App\Http\Controllers\dashboard\QuestionsController::class,'showDescriptive'])->name('QuestionsController.showDescriptive');
    Route::post('/create/descriptive',[\App\Http\Controllers\dashboard\QuestionsController::class,'storeDescriptive'])->name('QuestionsController.storeDescriptive');
    Route::get('/create/test',[\App\Http\Controllers\dashboard\QuestionsController::class,'showTest'])->name('QuestionsController.showTest');
    Route::post('/create/test',[\App\Http\Controllers\dashboard\QuestionsController::class,'storeTest'])->name('QuestionsController.storeTest');
    Route::get('/show/questions',[\App\Http\Controllers\dashboard\QuestionsController::class,'showQuestions'])->name('QuestionsController.showQuestions');
    Route::delete('/delete/{id}',[\App\Http\Controllers\dashboard\QuestionsController::class,'delete'])->name('QuestionsController.delete');
    Route::post('/edit/test/{id}',[\App\Http\Controllers\dashboard\QuestionsController::class,'editTestShow'])->name('QuestionsController.editTestShow');
    Route::post('/update/test/{id}',[\App\Http\Controllers\dashboard\QuestionsController::class,'editTestStore'])->name('QuestionsController.editTestStore');
    Route::post('/edit/descriptive/{id}',[\App\Http\Controllers\dashboard\QuestionsController::class,'editDescriptiveShow'])->name('QuestionsController.editDescriptiveShow');
    Route::post('/update/descriptive/{id}',[\App\Http\Controllers\dashboard\QuestionsController::class,'editDescriptiveStore'])->name('QuestionsController.editDescriptiveStore');
});
//Exam Route
Route::group(['prefix'=>'/exams','middleware'=>'auth:admin,teacher,student'],function (){
    Route::get('/show-teacher-course',[\App\Http\Controllers\dashboard\ExamsController::class,'showTeacherCourse'])->name('ExamsController.showTeacherCourse');
    Route::get('/show-course-exam/{id}',[\App\Http\Controllers\dashboard\ExamsController::class,'showExams'])->name('ExamsController.showExams');
    Route::get('/add-exam-show/{id}',[\App\Http\Controllers\dashboard\ExamsController::class,'addExamShow'])->name('ExamsController.addExamShow');
    Route::post('/add-exam-store/{id}',[\App\Http\Controllers\dashboard\ExamsController::class,'addExamStore'])->name('ExamsController.addExamStore');
    Route::delete('/delete/exam/{id}',[\App\Http\Controllers\dashboard\ExamsController::class,'dropExam'])->name('ExamsController.delete');
    Route::get('/edit/exam/{id}',[\App\Http\Controllers\dashboard\ExamsController::class,'editExamShow'])->name('ExamsController.editExam');
    Route::post('/edit/exam/store/{id}',[\App\Http\Controllers\dashboard\ExamsController::class,'editExamStore'])->name('ExamsController.editExamStore');
    Route::get('/mange/quiz/question/{id}',[\App\Http\Controllers\dashboard\ExamsController::class,'showQuizQuestion'])->name('ExamsController.showQuizQuestion');
    Route::delete('/manage/quiz/delete/question/{id}',[\App\Http\Controllers\dashboard\ExamsController::class,'deleteQuestionInExam'])->name('ExamsController.deleteQuestionInExam');
    Route::post('/add/questions/exam/{id}',[\App\Http\Controllers\dashboard\ExamsController::class,'addQuestionsInexam'])->name('ExamsController.addQuestionsInexam');
});
// Student Route
Route::group(['prefix'=>'/student','middleware'=>'auth:admin,teacher,student'],function (){
    Route::get('/courses/list',[\App\Http\Controllers\dashboard\StudentController::class,'showStudentCourse'])->name('StudentController.showStudentCourse');
    Route::get('/course/{id}/exams',[\App\Http\Controllers\dashboard\StudentController::class,'showExamsCourse'])->name('StudentController.showExamsCourse');
    Route::get('/course/exam/{id}/questions',[\App\Http\Controllers\dashboard\StudentController::class,'showQuestionInExam'])->name('StudentController.showQuestionInExam');
});
// Notification
Route::group(['prefix'=>'/student','middleware'=>'auth:admin,teacher,student'],function (){
    Route::get('/read/notification/{id}',[\App\Http\Controllers\NotificationsController::class,'read'])->name('NotificationsController.read');
});
