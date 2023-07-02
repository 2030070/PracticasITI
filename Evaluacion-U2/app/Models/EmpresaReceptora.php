<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaReceptora extends Model
{
    use HasFactory;
    protected $table = 'empresas_receptoras';

    protected $fillable = [
        'nombre', 
        'direccion', 
        'rfc',
        'contacto',
        'email',
    ];
}
