<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AsignacionIndividual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion_individual', function (Blueprint $table) {
        $table->bigIncrements('id_asignacion_individual');
        $table->string('id_user_tutor');
        $table->string('id_user_alumno');
        $table->dateTime('fecha_created');
        //$table->json('horario');
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
