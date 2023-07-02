<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaEmisora extends Model{
    use HasFactory;

    //Con esta linea hacemos mención de a que tabla es donde estamos haciendo el modelo 
    protected $table = 'empresas_emisoras';

    //Variables de la tabla para el almacenamiento de los datos a ingresar 
    protected $fillable = [
        'razon_social', 
        'correo_contacto', 
        'rfc_emisor'];

}
