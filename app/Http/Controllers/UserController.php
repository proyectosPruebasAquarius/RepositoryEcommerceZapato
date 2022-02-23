<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Direccion;
use App\Models\DireccionFacturaccion;
use App\Models\Review;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user()->id;
        $direcciones = Direccion::join('municipios', 'direcciones.id_municipio', '=', 'municipios.id')
        ->join('departamentos', 'municipios.id_departamento', '=', 'departamentos.id')->where('id_user', $user)
        ->select('direcciones.*', 'departamentos.nombre as departamento', 'municipios.nombre as municipio', 'municipios.id_departamento')->get();
        $facturaciones = DireccionFacturaccion::join('municipios', 'direcciones_facturaciones.id_municipio', '=', 'municipios.id')
        ->join('departamentos', 'municipios.id_departamento', '=', 'departamentos.id')->where('id_user', $user)
        ->select('direcciones_facturaciones.*', 'departamentos.nombre as departamento', 'municipios.nombre as municipio', 'municipios.id_departamento')->get();
        $valoraciones = Review::join('productos', 'opiniones.id_producto', '=', 'productos.id')->where('id_usuario', $user)->select('opiniones.*', 'productos.nombre')->get();
        return view('frontend.layouts.perfil')->with('direcciones', $direcciones)->with('facturaciones', $facturaciones)->with('valoraciones', $valoraciones);
    }
}
