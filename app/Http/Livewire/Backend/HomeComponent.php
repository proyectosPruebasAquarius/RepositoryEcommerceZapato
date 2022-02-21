<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use App\Models\Venta;
use App\Models\User;
use App\Models\DetalleVenta;
use DB;
class HomeComponent extends Component
{
    public $DailySales = [],$MonthSales = [],$YearSales = [],$today,$year,$month,$lastUserRegister = [],
    $bestSellingProduct = [],$MaxBuyerCostumer = [],$bestSellingCategory =[],$bestSellingSubCategory = [],$bestSellingProducts=[],
    $bestSellingSubCategories = [],$MaxBuyerCostumers = [],$MinBuyerCostumers =[]
    ;




    public function render()
    {







        $this->bestSellingProduct =  DetalleVenta::join('productos','productos.id','=','detalle_ventas.id_producto')->join('ventas','detalle_ventas.id_venta','=','ventas.id')->where('ventas.estado','=',1)
        ->select('productos.nombre as producto',DB::raw('COUNT(detalle_ventas.id_producto) AS cuentaTotal'))
        ->groupBy('detalle_ventas.id_producto')->orderBy('cuentaTotal','DESC')->limit(1)->get();
        
        $this->MaxBuyerCostumer = Venta::join('users','users.id','=','ventas.id_usuario')->where('ventas.estado','=',1)->select('users.name as nombre','users.email as correo',DB::raw('FORMAT(SUM(ventas.total),2) AS sumtotal'))->groupBy('users.name')
        ->orderBy('sumtotal','desc')->distinct()->limit(1)->get();

        $this->bestSellingCategory =  DetalleVenta::join('productos','productos.id','=','detalle_ventas.id_producto')->join('detalles_productos','productos.id_detalle_producto','=','detalles_productos.id')
        ->join('categorias','categorias.id','=','detalles_productos.id_categoria')
        ->join('ventas','detalle_ventas.id_venta','=','ventas.id')->where('ventas.estado','=',1)
        ->select('categorias.nombre as categoria',DB::raw('COUNT(detalles_productos.id_categoria) AS cuentaTotal'))
        ->groupBy('detalles_productos.id_categoria')->orderBy('cuentaTotal','DESC')->limit(1)->get();
        $this->bestSellingSubCategory =  DetalleVenta::join('productos','productos.id','=','detalle_ventas.id_producto')->join('detalles_productos','productos.id_detalle_producto','=','detalles_productos.id')
        ->join('sub_categorias','sub_categorias.id','=','detalles_productos.id_sub_categoria')
        ->join('ventas','detalle_ventas.id_venta','=','ventas.id')->where('ventas.estado','=',1)
        ->select('sub_categorias.nombre as subcategoria',DB::raw('COUNT(detalles_productos.id_sub_categoria) AS cuentaTotal'))
        ->groupBy('detalles_productos.id_sub_categoria')->orderBy('cuentaTotal','DESC')->limit(1)->get();





        $this->bestSellingProducts =  DetalleVenta::join('productos','productos.id','=','detalle_ventas.id_producto')
        ->join('ventas','detalle_ventas.id_venta','=','ventas.id')->where('ventas.estado','=',1)
        ->select('productos.imagen','productos.nombre as producto',DB::raw('COUNT(detalle_ventas.id_producto) AS cuentaTotal'))
        ->groupBy('detalle_ventas.id_producto')->orderBy('cuentaTotal','DESC')->limit(5)->get();

        $this->bestSellingSubCategories =  DetalleVenta::join('productos','productos.id','=','detalle_ventas.id_producto')->join('ventas','detalle_ventas.id_venta','=','ventas.id')
        ->join('detalles_productos','detalles_productos.id','=','productos.id_detalle_producto')
        ->join('sub_categorias','sub_categorias.id','=','detalles_productos.id_sub_categoria')->where('ventas.estado','=',1)
        ->select('sub_categorias.nombre as subcategoria',DB::raw('COUNT(detalles_productos.id_sub_categoria) AS cuentaTotal'))
        ->groupBy('detalles_productos.id_sub_categoria')->orderBy('cuentaTotal','DESC')->limit(5)->get();




        $this->MaxBuyerCostumers = Venta::join('users','users.id','=','ventas.id_usuario')->where('ventas.estado','=',1)->select('users.name as nombre','users.email as correo',DB::raw('FORMAT(SUM(ventas.total),2) sumtotal'),DB::raw('COUNT(ventas.id_usuario) as cuentaCompras'))
       ->groupBy('users.name')
       ->orderBy('cuentaCompras','desc')->distinct()->limit(5)->get();


       $this->MinBuyerCostumers = Venta::join('users','users.id','=','ventas.id_usuario')->where('ventas.estado','=', 1)->select('users.name as nombre','users.email as correo',DB::raw('FORMAT(SUM(ventas.total),2) sumtotal'),DB::raw('COUNT(ventas.id_usuario) as cuentaCompras'))
       ->groupBy('users.name')
       ->orderBy('cuentaCompras','asc')->distinct()->limit(5)->get();




        
        $this->today =date("Y-m-d");
        $this->year = date("Y");
        $this->month = date("m");
        $this->DailySales =  Venta::whereDate('ventas.created_at','=',$this->today)->where('ventas.estado','=',1)
        ->select(DB::raw('FORMAT(SUM(ventas.total),2) AS cuentaTotal'))->get();
        $this->MonthSales =  Venta::select(DB::raw('FORMAT(SUM(ventas.total),2) AS cuentaTotal'))
        ->whereMonth('ventas.created_at', $this->month)->where('ventas.estado','=',1)->get();
        $this->YearSales =  Venta::select(DB::raw('FORMAT(SUM(ventas.total),2) AS cuentaTotal'))
        ->whereYear('ventas.created_at', $this->year)->where('ventas.estado','=',1)->get();



        return view('livewire.backend.home-component');
    }
}
