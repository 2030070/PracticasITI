<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionProducto extends Model
{
    use HasFactory;

    protected $table = "cotizacion_productos";

    protected $fillable = [
        'cotizacion_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    public function cotizacion(){
        return $this->belongsTo(Cotizacion::class, 'cotizacion_id');
    }

    public function producto(){
        return $this->belongsTo(Producto::class, 'producto_id');
    }

}
