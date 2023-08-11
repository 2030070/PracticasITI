<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $table = 'ventas';

    protected $fillable = ['fecha_venta', 'cliente_id', 'estatus', 'pago', 'subtotal', 'descuento', 'impuestos', 'total', 'pago_monto', 'vendedor_id'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'vendedor_id');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class)->withPivot('cantidad');
    }
}
