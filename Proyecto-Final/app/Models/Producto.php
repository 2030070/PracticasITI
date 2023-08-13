<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'imagen',
        'categoria_id',
        'subcategoria_id',
        'marca_id',
        'nombre',
        'precio_compra',
        'precio_venta',
        'unidades_disponibles',
        'creado_por',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class); // Agrega la relación con el modelo "Marca"
    }


    public function cotizaciones()
    {
        return $this->belongsToMany(Cotizacion::class)->using(CotizacionProducto::class)->withPivot('cantidad', 'precio_unitario', 'subtotal');
    }


}
