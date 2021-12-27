<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStartexamsTable extends Migration
{
    public function up()
    {
        Schema::create('startexams', function (Blueprint $table) {
            $table->unsignedBigInteger('exam_num')->primary();
            $table->bigInteger('user_id');
            $table->boolean('status')->default(1);
            $table->integer('time');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('startexams');
    }
}
