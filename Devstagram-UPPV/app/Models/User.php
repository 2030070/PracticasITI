<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/* Modelo de User en el se generan los campos de nombre, email, contraseña y el usernem del usuario
elementos que seran mostrados en diverso contenido de los views */
class User extends Authenticatable{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];


    //crear metodo de relacion 
    public function post(){
        //relacion donde un usuario puede tener multiples post de publicaciones
        return $this->hasMany(posts::class);
    }

    //creamos una relacion de posts (uno) a user 
    public function user(){
        //relacion donde un usuario puede tener multiples post de publicaciones donde obtenemos el username del usuario
        return $this->belongsTo(User::class)->selected(['name','username']);
    }
    
    //Relación de con la tabla post
    public function comentario(){
        return $this->hasMany(posts::class);
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
