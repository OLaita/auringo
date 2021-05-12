<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('desCorta');
            $table->integer('meta');
            $table->integer('financiacionActual');
            $table->string('section')->nullable();
            $table->unsignedBigInteger('idCategoria');
            $table->string('iban');
            $table->unsignedBigInteger('iduser');
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->string('fotoProyecto');
            $table->foreign('iduser')->references('id')->on('users');
            $table->foreign('idCategoria')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyectos');
    }
}
