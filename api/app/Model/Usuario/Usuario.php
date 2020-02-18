<?php

namespace App\Model\Usuario;

use Illuminate\Foundation\Auth\User;
use Tymon\JWTAuth\Contracts\JWTSubject;
// use Illuminate\Notifications\Notifiable;

class Usuario extends User implements JWTSubject
{
    public $primaryKey = 'sr_id';
    public $timestamps = false;
    public $table = 'gata_cheirosa.tb_usuarios';
    
    protected $hidden = [
        'vc_senha', 'ch_excluido'
    ];
    protected $fillable = [
        'vc_nome', 'vc_email', 'vc_senha', 'ch_excluido'
    ];
    
    //use Notifable;

    protected $username = 'vc_login';
    
    public function getAuthPassword() { 
        return $this->attributes['vc_senha']; 
    }
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'nome'=> $this->vc_nome,
            'email'=>$this->vc_email,
            'login'=>$this->vc_login,
            'id'=>$this->sr_id
        ];
    }

}
