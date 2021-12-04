<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistersTable extends Migration
{
    public function up()
    {
        Schema::create('course_user', function (Blueprint $table) {
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("course_id");
            $table->foreign("user_id")->references("id")->on("users")
                ->cascadeOnDelete("CASCADE")
                ->cascadeOnUpdate("CASCADE");
            $table->foreign("course_id")->references("id")->on("courses")
                ->cascadeOnDelete("CASCADE")
                ->cascadeOnUpdate("CASCADE");
            $table->unique(['user_id','course_id']);
        });
    }
    public function down()
    {
        Schema::dropIfExists('course_user');
    }
}
