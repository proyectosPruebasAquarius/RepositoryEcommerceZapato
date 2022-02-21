<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'banners';
    protected $primaryKey = 'id';
    protected $fillable = [
        'titulo',
        'sub_titulo',
        'descripcion',
        'imagen'
    ];
}
