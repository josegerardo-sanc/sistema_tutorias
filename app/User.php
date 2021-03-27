<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use App\datos_alumnos;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\Model;

use App\SocialProfile;
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'tipo_usuario',
        'curp',
        'rfc',
        'nombre',
        'ap_paterno',
        'ap_materno',
        'genero',
        'fecha_nacimiento',
        'localidad',
        'telefono',
        'email',
        'password',
        'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function socialProfiles(){
        return $this->hasMany(SocialProfile::class);
    }
}
