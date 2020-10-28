<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('tipo_usuario',['tutor','asesor', 'alumno','director','subdirector','administrador']);
            $table->string('curp')->unique();
            $table->string('rfc');
            $table->string('nombre');
            $table->string('ap_paterno');
            $table->string('ap_materno')->nullable();
            $table->string('genero');
            $table->date('fecha_nacimiento');
            $table->string('localidad');
            $table->string('telefono')->unique();
            $table->string('email')->unique();
            $table->string('active')->comment('1:active 2:inactivo 3:pendiente');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo');
            $table->rememberToken();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
