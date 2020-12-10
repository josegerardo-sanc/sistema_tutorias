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
        $user=User::find(1);
        $user->assignRole($role1);

        $role2 = Role::create(['name' => 'Alumno']);
        $user=User::find(2);
        $user->assignRole($role2);

        $role3 = Role::create(['name' => 'Tutor']);
        $user=User::find(3);
        $user->assignRole($role3);

        $role4 = Role::create(['name' => 'Asesor']);
        $role5 = Role::create(['name' => 'Director']);
        $role6 = Role::create(['name' => 'SubDirector']);

        // usuarios del sistemas
        Permission::create(['name' => 'crear.usuario']);
        Permission::create(['name' => 'actualizar.usuario']);
        Permission::create(['name' => 'listar.usuario']);
        Permission::create(['name' => 'eliminar.usuario']);
        Permission::create(['name' => 'activar_desactivar_cuenta.usuario']);
        Permission::create(['name' => 'cambiar_password.usuario']);

        // formatos
        Permission::create(['name' => 'crear.formato']);
        Permission::create(['name' => 'actualizar.formato']);
        Permission::create(['name' => 'listar.formato']);
        Permission::create(['name' => 'eliminar.formato']);

        // reportes
        Permission::create(['name' => 'crear.reporte']);
        Permission::create(['name' => 'actualizar.reporte']);
        Permission::create(['name' => 'listar.reporte']);
        Permission::create(['name' => 'eliminar.reporte']);

        // carreras
        Permission::create(['name' => 'crear.carrera']);
        Permission::create(['name' => 'actualizar.carrera']);
        Permission::create(['name' => 'listar.carrera']);
        Permission::create(['name' => 'eliminar.carrera']);

        //asignacion tutorgrupal
        Permission::create(['name' => 'crear.asignacion_grupal']);
        Permission::create(['name' => 'actualizar.asignacion_grupal']);
        Permission::create(['name' => 'listar.asignacion_grupal']);
        Permission::create(['name' => 'eliminar.asignacion_grupal']);

        //asignacion Individual
        Permission::create(['name' => 'crear.asignacion_individual']);
        Permission::create(['name' => 'actualizar.asignacion_individual']);
        Permission::create(['name' => 'listar.asignacion_individual']);
        Permission::create(['name' => 'eliminar.asignacion_individual']);






    }
}
