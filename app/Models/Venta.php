<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    
    protected $table = 'ventas';
    protected $primaryKey = 'id';
    protected $fillable = ['id_usuario',
    'total',
    'num_transaccion',
    'estado',
    'id_metodo_pago',
    'id_facturacion',
    'recoger_tienda'
    ];
}
