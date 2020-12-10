<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PreguntasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('preguntas')->insert([
            ['pregunta' => '1.- El Docente Tutor genera un clima de confianza y buena comunicación con todo el grupo'],
            ['pregunta' => '2.- El Docente Tutor hace agradable la sesión de tutoría.'],
            ['pregunta' => '3.- El Docente tutor escucha con atención todo lo que se le solicita.'],
            ['pregunta' => '4.- El Docente Tutor, brinda la información necesaria sobre el programa de tutoría.'],
            ['pregunta' => '5.- El Docente Tutor proporciona información suficiente sobre los apoyos que requiere el estudiante'],
            ['pregunta' => '6.- El Docente tutor brinda información y orientación importante que apoye al área personal del tutorado'],
            ['pregunta' => '7.- El Docente Tutor informa con precisión sobre las asesorías académicas que ofrecen los Docentes de sus carreras'],
            ['pregunta' => '8.- Al Docente Tutor, se le puede localizar en cualquier momento.'],
            ['pregunta' => '9.- El Docente tutor te proporciono su horario desde el inicio del semestre.'],
            ['pregunta' => '10.- El Docente Tutor, atiende con amabilidad cada que se le necesite'],
            ['pregunta' => '11.- El Docente Tutor canaliza adecuadamente al área correspondiente, siempre que tienes algún problema y no puede ayudarte a resolverlo.'],
            ['pregunta' => '12.- El Docente Tutor, muestra tener las herramientas necesarias para atender al grupo y/o individualmente'],
            ['pregunta' => '13.- El Docente Tutor, realiza la programación de las sesiones considerando los tiempos disponibles de los estudiantes.'],
            ['pregunta' => '14.- El Docente Tutor, muestra evidencia de que planeó las sesiones individuales y grupales con sus tutorados pues lleva un orden en sus actividades.'],
            ['pregunta' => '15.- El Docente tutor planea, ejecuta y evalúa su actividad tutorial continuamente con fines de retroalimentación']

        ]);
    }
}
