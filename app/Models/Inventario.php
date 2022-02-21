<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $table = 'inventarios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'precio_compra',
        'precio_venta',
        'precio_descuento',
        'stock',
        'min_stock',
        'id_producto',
        'id_oferta',
        'estado'
    ];
}
