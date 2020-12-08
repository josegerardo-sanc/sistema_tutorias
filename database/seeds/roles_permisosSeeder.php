<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class roles_permisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // ADMINISTRADOR
        $role1 = Role::create(['name' => 'Administrador']);
                 Permission::create(['name' => 'registrar AdminUsuario']);
                 Permission::create(['name' => 'desactivarCuenta AdminUsuario']);
                 Permission::create(['name' => 'listar AdminUsuario']);
                 Permission::create(['name' => 'actualizar AdminUsuario']);
                 Permission::create(['name' => 'crearFormato AdminFormato']);

        $role1->givePermissionTo([
                    'registrar AdminUsuario',
                    'desactivarCuenta AdminUsuario',
                    'listar AdminUsuario',
                    'actualizar AdminUsuario',
                    'crearFormato AdminFormato'
                    ]);

        $user=User::find(1);
        $user->assignRole(['Administrador']);

        //ALUMNO
        $role2 = Role::create(['name' => 'Alumno']);
                 Permission::create(['name' =>'misDatos alumno']);

        $role2->givePermissionTo([
                    'misDatos alumno'
                    ]);

        $user=User::find(2);
        $user->assignRole(['Alumno']);


        // Tutor
        $role3 = Role::create(['name' => 'Tutor']);


    }
}
