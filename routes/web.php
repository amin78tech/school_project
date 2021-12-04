<?php
use Illuminate\Support\Facades\Route;
//Auth
Route::get("/register",[\App\Http\Controllers\UserRegisterController::class,"create"])->name("UserRegisterController.create");
Route::post("/register",[\App\Http\Controllers\UserRegisterController::class,"store"])->name("UserRegisterController.store");
//Users Route
Route::prefix("/users")->group(function (){
    Route::get("/list",[\App\Http\Controllers\dashboard\UsersController::class,"index"])->name("UserController.index");
    Route::put("/update/status/{id}",[\App\Http\Controllers\dashboard\UsersController::class,"updateStatus"])->name("UserController.updateStatus");
    Route::get("/update/profile/{id}",[\App\Http\Controllers\dashboard\UsersController::class,"edit"])->name("UserController.edit");
    Route::post("/update/profile/{id}",[\App\Http\Controllers\dashboard\UsersController::class,"update"])->name("UserController.update");
    Route::delete("/delete/{id}",[\App\Http\Controllers\dashboard\UsersController::class,"destroy"])->name("UserController.destroy");
    Route::post("/search",[\App\Http\Controllers\dashboard\UsersController::class,"show"])->name("UsersController.show");
});
//Course Route
Route::prefix("/courses")->group(function (){
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
