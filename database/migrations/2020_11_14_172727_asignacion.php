<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Asignacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion', function (Blueprint $table) {
        $table->bigIncrements('id_asignacion');
        $table->string('semestre');
        $table->string('carrera');
        $table->enum('turno',['Matutino','Vespertino']);
        $table->enum('grupo',['A','B']);
        $table->string('user_register');
        $table->unsignedBigInteger('user_id_asignado');
        $table->dateTime('fecha_created');
        $table->enum('periodo',['FEBRERO-JULIO','AGOSTO-DICIEMBRE']);
        $table->json('horario');
        $table->foreign('user_id_asignado')->references('id')->on('users');

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
