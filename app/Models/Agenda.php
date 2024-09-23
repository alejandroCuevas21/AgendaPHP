<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
       'id', 'Nombre', 'Domicilio', 'Numero', 'Colonia', 'CP', 
        'Ciudad', 'Estado', 'Telefono', 'Correo', 
        'Latitud', 'Longitud'
    ];
}
