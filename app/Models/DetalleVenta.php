<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;
    protected $table = 'detalle_ventas';
    protected $primaryKey = 'id';
    protected $fillable = ['id_producto',
    'id_venta',
    'cantidad',
    'id_color',
    'id_talla'
    ]; 
}
