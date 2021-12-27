<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsTable extends Migration
{
    public function up()
    {
        Schema::create('respons', function (Blueprint $table) {
            $table->id();
            $table->integer('bank_id');
            $table->integer('user_id');
            $table->string('respon')->nullable();
            $table->integer('score');
            $table->unsignedBigInteger('exam_id');
            $table->foreign('exam_id')->references('exam_num')->on('startexams')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('respons');
    }
}
