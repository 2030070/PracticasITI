<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compras';

    protected $fillable = [
        'producto_id',
        'proveedor_id',
        'referencia',
        'fecha',
        'cantidad',
        'total',
        'creado_por',
    ];

    public function producto(){
        return $this->belongsTo(Producto::class);
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class);
    }

    public function creador()
    {
        return $this->belongsTo(User::class, 'creado_por');
    }


}
