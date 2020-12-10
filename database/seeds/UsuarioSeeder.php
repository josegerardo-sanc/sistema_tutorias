<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // factory(App\User::class,300)->create();

        App\User::create([
            'tipo_usuario' => 'administrador',
            'curp' =>'SAAG950819HTCNLR07',
            'rfc' =>'987',
            'nombre' =>'Jose Gerardo',
            'ap_paterno'=>'Sanchez',
            'ap_materno'=>'Alvarado',
            'genero'=>'masculino',
            'fecha_nacimiento'=>'1995-08-19',
            'code_postal'=>'86800',
            'localidad'=>'126539',
            'telefono'=>'9321078928',
            'email' =>'sanchzalvaradojose0@gmail.com',
            'active'=>'1',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'photo'=>'Recursos_sistema/upload_image.png',
            'remember_token' => Str::random(10),
        ]);

        App\User::create([
            'tipo_usuario' => 'alumno',
            'curp' =>'SAAG950819HTCNLR11',
            'rfc' =>'987',
            'nombre' =>'Jose Gerardo alumno',
            'ap_paterno'=>'Sanchez',
            'ap_materno'=>'Alvarado',
            'genero'=>'masculino',
            'fecha_nacimiento'=>'1995-08-19',
            'code_postal'=>'86800',
            'localidad'=>'126539',
            'telefono'=>'9321078945',
            'email' =>'alumno@gmail.com',
            'active'=>'1',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'photo'=>'Recursos_sistema/upload_image.png',
            'remember_token' => Str::random(10),
        ]);
        App\User::create([
            'tipo_usuario' => 'tutor',
            'curp' =>'SAAG950819HTCNLR01',
            'rfc' =>'987',
            'nombre' =>'Jose Gerardo tutor',
            'ap_paterno'=>'Sanchez',
            'ap_materno'=>'Alvarado',
            'genero'=>'masculino',
            'fecha_nacimiento'=>'1995-08-19',
            'code_postal'=>'86800',
            'localidad'=>'126539',
            'telefono'=>'9321078929',
            'email' =>'tutor0@gmail.com',
            'active'=>'1',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'photo'=>'Recursos_sistema/upload_image.png',
            'remember_token' => Str::random(10),
        ]);

        DB::table('carreras')->insert([
            ['carrera' => 'Ing.Informática', 'created_at' =>now()],
            ['carrera' => 'Ing.Administración', 'created_at' =>now()],
            ['carrera' => 'Ing.Energías Renovable', 'created_at' =>now()],
            ['carrera' => 'Ing.Bioquímica', 'created_at' =>now()],
            ['carrera' => 'Ing.Industrial', 'created_at' =>now()],
            ['carrera' => 'Ing.Electromecánica', 'created_at' =>now()],
            ['carrera' => 'Ing.Agronomía', 'created_at' =>now()],
        ]);

    }
}
