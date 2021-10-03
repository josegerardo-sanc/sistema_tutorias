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
        $role3 = Role::create(['name' => 'Tutor']);
        $role4 = Role::create(['name' => 'Asesor']);
        $role5 = Role::create(['name' => 'Director']);
        $role6 = Role::create(['name' => 'Subdirector']);

    }
}
