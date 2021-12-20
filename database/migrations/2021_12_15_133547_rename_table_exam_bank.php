<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTableExamBank extends Migration
{
    public function up()
    {
        Schema::rename('exam_bank', 'bank_exam');
    }

    public function down()
    {

    }
}
