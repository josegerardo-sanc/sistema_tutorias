<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Archivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos', function (Blueprint $table) {
            $table->bigIncrements('id_archivo');
            $table->string('titulo');
            $table->string('descripcion');
            $table->string('ruta_archivo');
            $table->json('datos_tipo_archivo');
            $table->enum('tipo_archivo',['formato','reporte']);
            $table->dateTime('fecha_created_archivo');
            $table->dateTime('fecha_update_archivo');
            $table->string('id_user_upload');
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
