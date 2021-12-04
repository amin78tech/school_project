<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("name",150);
            $table->timestamp("start_date")->nullable();
            $table->timestamp("end_date")->nullable();
            $table->foreign("user_id")->references("id")->on("users")
                ->cascadeOnDelete("CASCADE")
                ->cascadeOnUpdate("CASCADE");
            $table->timestamps();
            $table->timestamp("deleted_at");
        });
    }
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
