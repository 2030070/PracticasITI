<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    use HasFactory;

    protected $table = 'subcategorias';
    protected $fillable = [
        'categoria_id', 
        'codigo', 
        'nombre', 
        'descripcion', 
        'creado_por'
    ];
    
    // Relación con la tabla "categorias"
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
