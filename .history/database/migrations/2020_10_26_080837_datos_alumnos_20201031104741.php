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
        $table->string('carrera')->comment('1:informatica 2:administracion 3:renovable 4:bioquimica 5:electromecanica');
        $table->string('grupo')->comment('1:A 2:B');
        $table->string('turno')->comment('1:vespertino 2:matunino');
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
