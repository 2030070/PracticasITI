<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CotizacionProducto extends Pivot
{
    protected $table = 'cotizacion_producto';
}
