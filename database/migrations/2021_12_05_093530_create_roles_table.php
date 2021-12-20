<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string('label')->nullable();
            $table->string('guard')->nullable();
            $table->timestamps();
            $table->timestamp("deleted_at")->nullable();
        });
    }
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
