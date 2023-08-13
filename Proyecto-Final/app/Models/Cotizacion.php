<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $table = 'cotizaciones';

    protected $fillable = [
        'fecha_cotizacion',
        'cliente_id',
        'referencia',
        'status',
        'descripcion',
        'impuestos',
        'subtotal',
        'total',
    ];

    public function productos()
    {
        return $this->belongsToMany(Producto::class)->using(CotizacionProducto::class)->withPivot('cantidad', 'precio_unitario', 'subtotal');
    }

    
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
