<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model{
    use HasFactory;
    
    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'creado_por',
    ];

    
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

}
