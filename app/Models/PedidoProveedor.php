<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoProveedor extends Model
{
    use HasFactory;
    protected $table = 'pedidos_proveedores';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_proveedor',
        'id_inventario',
        'cantidad',
        'precio',
        'fecha_entrega',
        'estado'
        ];
}
