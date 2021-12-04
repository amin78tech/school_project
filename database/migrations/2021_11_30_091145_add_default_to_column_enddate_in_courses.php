<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultToColumnEnddateInCourses extends Migration
{
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->date("deleted_at")->nullable()->change();
        });
    }
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->date("deleted_at")->change();
        });
    }
}
