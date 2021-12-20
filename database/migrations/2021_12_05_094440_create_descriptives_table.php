<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescriptivesTable extends Migration
{
    public function up()
    {
        Schema::create('descriptives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bank_id');
            $table->foreign('bank_id')->references('id')->on('banks')
                ->cascadeOnDelete('CASCADE')
                ->cascadeOnUpdate('CASCADE');
            $table->string('title');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('descriptives');
    }
}
