<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DatosDocentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_docentes', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('cedula_profesional')->unique();
        $table->unsignedBigInteger('user_id_docente');
        $table->foreign('user_id_docente')->references('id')->on('users');
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
