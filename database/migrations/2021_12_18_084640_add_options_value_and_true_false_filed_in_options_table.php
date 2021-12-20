<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOptionsValueAndTrueFalseFiledInOptionsTable extends Migration
{
    public function up()
    {
        Schema::table('options', function (Blueprint $table) {
            $table->string('option_value');
            $table->boolean('true_false');
        });
    }
    public function down()
    {
        Schema::table('options', function (Blueprint $table) {
            $table->dropColumn('option_value');
            $table->dropColumn('true_false');
        });
    }
}
