<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    use HasFactory;
    protected $table = 'devoluciones';
    protected $fillable = [
        'nombre_producto',
        'fecha_devolucion',
        'cliente',
        'estatus',
        'precio_total',
        'pagado',
        'adeudo',
        'estatus_pago',
        'creado_por',
    ];
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
