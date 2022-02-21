<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleColor extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'detalles_colores';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_producto',
        'id_color'
    ];
}
