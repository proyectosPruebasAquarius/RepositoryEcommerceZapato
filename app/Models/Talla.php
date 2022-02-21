<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tallas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'estado',
       
    ];
}
