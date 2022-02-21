<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'opiniones';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'descripcion', 'rating', 'id_usuario', 'id_producto'];
}
