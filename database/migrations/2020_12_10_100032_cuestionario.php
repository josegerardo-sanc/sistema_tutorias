<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cuestionario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuestionario', function (Blueprint $table) {
            $table->bigIncrements('id_cuestionario');
            $table->json('respuestas_cuestionario');
            $table->string('observacion')->nullable();
            $table->enum('tipo_cuestionario',['grupal','individual']);
            $table->dateTime('fecha_created_cuestionario');
            $table->dateTime('fecha_update_cuestionario');
            $table->string('id_user_alumno');
            $table->string('id_user_tutor');
            $table->enum('periodo',['FEBRERO-JULIO','AGOSTO-DICIEMBRE']);

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
