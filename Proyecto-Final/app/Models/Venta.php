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
        'cliente_id',
        'referencia',
        'pago',
        'total',
        'creado_por',
    ];

    public function productos()
    {
        return $this->belongsToMany(Producto::class)->using(VentasProducto::class)->withPivot('cantidad')->withTrashed();
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function vendedor(){
        return $this->belongsTo(User::class, 'creado_por'); // Especifica la columna creada_por como clave foránea
    }

}
