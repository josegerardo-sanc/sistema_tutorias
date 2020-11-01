<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DatosAlumnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_alumnos', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('matricula')->unique();
        $table->enum('periodo',['FEBRERO-JULIO','AGOSTO-DICIEMBRE']);
        $table->string('semestre');
        $table->string('carrera');
        $table->string('grupo');
        $table->string('turno');
        $table->unsignedBigInteger('user_id_alumno');
        $table->foreign('user_id_alumno')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
