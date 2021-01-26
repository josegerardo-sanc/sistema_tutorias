<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EvaluaciontutorSpicologa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacion_tutor_spicologa', function (Blueprint $table) {
            $table->bigIncrements('id_evaluacion');
            $table->json('respuestas_evaluacion');
            $table->dateTime('fecha_evaluacion');
            $table->string('id_user');
            $table->string('id_carrera');
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
