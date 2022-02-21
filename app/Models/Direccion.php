<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;
    protected $table = 'direcciones';
    protected $primaryKey = 'id';
    protected $fillable = ['direccion', 'referencia', 'id_user', 'id_municipio']; 
}
