<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;



    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'estado',
        'cod',
        'imagen',
        'descripcion',
        'id_proveedor',
        'id_marca',
        'id_detalle_producto',
        'id_estilo',
        
    ];
}
