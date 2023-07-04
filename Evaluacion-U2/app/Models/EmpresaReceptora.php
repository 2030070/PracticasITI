<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaReceptora extends Model
{
    use HasFactory;
    //Se usa para detectar el nombre correcto en la base de datos para la tabla empresas_receptoras
    protected $table = 'empresas_receptoras';

    //Campos que contiene la tabla de empresa receptora
    protected $fillable = [
        'nombre', 
        'direccion', 
        'rfc',
        'contacto',
        'email',
    ];

    public function facturas(){
        return $this->hasMany(Factura::class, 'empresa_receptora_id');
    }
}
