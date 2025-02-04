<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comentario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/* Modelo de los post el cual tiene el titulo, la descripcion del modelo, la imagen extraida con dropzone 
   y el id del usuario para sus relaciones con el modelo de usuario*/
class posts extends Model{
    use HasFactory;
    //forszar el nombre de la tabla posts
    protected $table = 'posts';
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class)->select(['name','username']);
    }

    public function comentarios(){
        return $this->hasMany(Comentario::class,'post_id');
    }

}
