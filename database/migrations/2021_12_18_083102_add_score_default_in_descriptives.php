<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScoreDefaultInDescriptives extends Migration
{
    public function up()
    {
        Schema::table('descriptives', function (Blueprint $table) {
            $table->bigInteger('score');
        });
    }

    public function down()
    {
        Schema::table('descriptives', function (Blueprint $table) {
            $table->dropColumn('score');
        });
    }
}
