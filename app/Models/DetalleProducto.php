<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleProducto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'detalles_productos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_categoria',
        'id_sub_categoria'
    ];
}
