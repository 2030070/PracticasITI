<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compras';

    protected $fillable = [
        'nombre_producto',
        'nombre_proveedor',
        'referencia',
        'fecha',
        'estatus',
        'total',
        'pagado',
        'pendiente_de_pago',
        'estatus_de_pago',
        'creado_por',
    ];

    public function producto(){
        return $this->belongsTo(Producto::class);
    }

    
    public function proveedor(){
        return $this->belongsTo(Proveedor::class);
    }
}
