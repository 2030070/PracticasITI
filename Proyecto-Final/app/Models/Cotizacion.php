<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $table = 'cotizaciones';

    protected $fillable = [
        'producto_id',
        'referencia',
        'cliente_id',
        'estatus',
        'total_producto',
    ];

    public function producto(){
        return $this->belongsTo(Producto::class);
    }

    
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
