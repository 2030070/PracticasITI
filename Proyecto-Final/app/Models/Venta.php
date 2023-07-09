<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $table = 'ventas';

    protected $fillable = [
        'fecha',
        'nombre_cliente',
        'referencia',
        'estatus',
        'pago',
        'total',
        'pago_parcial',
        'pago_pendiente',
        'creado_por',
    ];
}
