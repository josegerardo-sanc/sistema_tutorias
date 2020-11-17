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
        factory(App\User::class,300)->create();

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
            'localidad'=>'',
            'telefono'=>'9321078928',
            'email' =>'sanchzalvaradojose0@gmail.com',
            'active'=>'1',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'photo'=>'sinfoto',
            'remember_token' => Str::random(10),
        ]);

    }
}
