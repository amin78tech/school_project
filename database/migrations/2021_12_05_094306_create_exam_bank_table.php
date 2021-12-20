<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamBankTable extends Migration
{
    public function up()
    {
        Schema::create('exam_bank', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('bank_id');
            $table->foreign('exam_id')->references('id')->on('exams')
                ->cascadeOnDelete('CASCADE')
                ->cascadeOnUpdate('CASCADE');
            $table->foreign('bank_id')->references('id')->on('banks')
                ->cascadeOnDelete('CASCADE')
                ->cascadeOnUpdate('CASCADE');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exam_bank');
    }
}
