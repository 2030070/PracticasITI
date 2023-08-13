<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class VentasProducto extends Pivot
{
    protected $table = 'producto_venta';
}
