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
       factory(App\User::class,1000)->create();

        App\User::create([
            'tipo_usuario' => 'administrador',
            'curp' =>'GAPE950418HTCRRD00',
            'rfc' =>'987',
            'nombre' =>'Daniel Garcia',
            'ap_paterno'=>'daniel',
            'ap_materno'=>'Garcia',
            'genero'=>'masculino',
            'fecha_nacimiento'=>'1995-08-19',
            'code_postal'=>'86800',
            'localidad'=>'126539',
            'telefono'=>'9321078928',
            'email' =>'daniel@gmail.com',
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
