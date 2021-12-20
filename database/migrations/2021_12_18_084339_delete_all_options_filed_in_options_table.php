<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteAllOptionsFiledInOptionsTable extends Migration
{
    public function up()
    {
        Schema::table('options', function (Blueprint $table) {
            $table->dropColumn('option_one');
            $table->dropColumn('option_two');
            $table->dropColumn('option_three');
            $table->dropColumn('option_four');
        });
    }

    public function down()
    {
        Schema::table('options', function (Blueprint $table) {
            $table->string('option_one');
            $table->string('option_two');
            $table->string('option_three');
            $table->string('option_four');
        });
    }
}
