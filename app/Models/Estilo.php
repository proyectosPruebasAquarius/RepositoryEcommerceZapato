<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estilo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'estilos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'estado',
       
    ];
}

