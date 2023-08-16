<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    use HasFactory;
    protected $table = 'devoluciones';

    protected $fillable = [
        'producto_id',
        'cantidad',
        'descripcion',
        'creado_por',
        'fecha_devolucion',
        'venta_id',
        'referencia'
    ];

    public function producto(){
        return $this->belongsTo(Producto::class);
    }

    public function venta(){
        return $this->belongsTo(Venta::class);
    }
}
