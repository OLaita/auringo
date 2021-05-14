<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotePlanUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivote_plan_usuario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUsuario');
            $table->unsignedBigInteger('idPlan');
            $table->foreign('idPlan')->references('id')->on('plans');
            $table->foreign('idUsuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pivote_plan_usuario');
    }
}
