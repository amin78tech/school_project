<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScoreColumnInBankExam extends Migration
{
    public function up()
    {
        Schema::table('exam_bank', function (Blueprint $table) {
            $table->integer('score');
        });
    }

    public function down()
    {
        Schema::table('exam_bank', function (Blueprint $table) {
            $table->dropColumn('score');
        });
    }
}
