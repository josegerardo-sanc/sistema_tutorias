<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class SocialProfile extends Model
{
    
    protected $fillable = ['id_user', 'name', 'email'];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
