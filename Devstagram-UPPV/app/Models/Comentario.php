<?php

namespace App\Models;

// use App\Models\User;
// use App\Models\posts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/* Modelo de comentario el cual contiene los elementos de id del usuario, id de post y el contenido del 
   comentario los id son necesarios para generar la relación con el modelo de Post y de Usuarios*/
class Comentario extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'post_id',
        'comentario',
    ];

    // Relaciones pata el uso del conentido de post, usuario y comentario 
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function posts(){
        return $this->belongsTo(posts::class);
    }
    public function comentario(){
        return $this->hasMany(posts::class);
    }

}
