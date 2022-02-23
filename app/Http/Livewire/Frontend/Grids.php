<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inventario;
use App\Models\Color;
use App\Models\Talla;
use App\Models\Marca;
use App\Models\Categoria;
use App\Models\SubCategoria;
use App\Models\Estilo;

class Grids extends Component
{
    /* public $categoria;
    public $sub_categoria; */
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    /* public $inventarios = array(); */
    public $colors = array();
    public $tallas = array();
    public $marcas = array();
    public $categorias = array();
    public $sub_categorias = array();
    public $estilos = array();
    public $pagination = 12;
    public $sortField = 'productos.nombre';
    public $sortDirection = 'asc';
    public $sortOrder;
    public $search;
    public $filtColors = array();
    public $filtTallas = array();
    public $filtPrecios = array();
    public $marca;
    public $categoria;
    public $sub_categoria;
    public $style;

    public function mount()
    {
        $this->corroborate($this->sub_categoria);        
    }

    public function corroborate($sub)
    {
        if (!empty($sub)) {
            $sub = SubCategoria::where([
                ['nombre', $sub],
                ['estado', 1]
            ])->count();
            $estilo = Estilo::where([
                ['nombre', $sub],
                ['estado', 1]
            ])->count();

            if ($estilo) {
                $this->style = $this->sub_categoria;
                $this->reset('sub_categoria');
            }
        }

    }

    public function render()
    {
        $search = '%'.$this->search.'%';
        $colors = $this->filtColors;
        $tallas = $this->filtTallas;
        $precios = $this->filtPrecios;
        $marca = $this->marca;
        $category = $this->categoria;
        $style = $this->style;
        $sub_categoria = $this->sub_categoria;

        $inventarios = Inventario::join('productos', 'inventarios.id_producto', '=', 'productos.id')
        ->leftJoin('detalles_colores', 'detalles_colores.id_producto', '=', 'productos.id')
        ->leftJoin('colores', 'detalles_colores.id_color', '=', 'colores.id')
        ->leftJoin('detalles_tallas', 'detalles_tallas.id_producto', '=', 'productos.id')
        ->leftJoin('tallas', 'detalles_tallas.id_talla', '=', 'tallas.id')
        ->join('detalles_productos', 'productos.id_detalle_producto', '=', 'detalles_productos.id')
        ->join('categorias', 'detalles_productos.id_categoria', '=', 'categorias.id')
        ->join('sub_categorias', 'detalles_productos.id_sub_categoria', '=', 'sub_categorias.id')
        ->join('estilos', 'productos.id_estilo', '=', 'estilos.id')
        ->when($search, function ($query) use ($search) {
            $query->where('productos.nombre', 'like', $search);
        })
        ->when($colors, function ($query) use ($colors) {
            /* foreach ($colors as $color) { */
                $query->whereIn('colores.nombre', $colors);
                /* \Debugbar::info($color); */
            /* } */
        })
        ->when($tallas, function ($query) use ($tallas) {            
                $query->whereIn('tallas.nombre', $tallas);            
        })
        ->when($precios, function ($query) use ($precios) {            
            $query->whereBetween('inventarios.precio_venta', $precios);            
        })
        ->when($marca, function ($query) use ($marca) { 
            $query->where('productos.id_marca', $marca);
        })
        ->when($category, function ($query) use ($category) { 
            $query->where('categorias.nombre', $category);
        })
        ->when($sub_categoria, function ($query) use ($sub_categoria) { 
            $query->where('sub_categorias.nombre', $sub_categoria);
        })
        ->when($style, function ($query) use ($style) { 
            $query->where('estilos.nombre', $style);
        })
        ->select('inventarios.*', 'productos.nombre', 'productos.imagen', 'productos.descripcion')
        ->where('inventarios.estado', 1)
        ->orderBy($this->sortField, $this->sortDirection)->groupBy('productos.nombre')->paginate($this->pagination);

        $this->colors = Color::where('estado', 1)->get();
        $this->tallas = Talla::where('estado', 1)->get();
        $this->marcas = Marca::where('estado', 1)->get(['nombre', 'id']);
        $this->categorias = Categoria::where('estado', 1)->get(['nombre', 'id']);
        $this->sub_categorias = SubCategoria::get(['nombre', 'id']);
        $this->estilos = Estilo::where('estado', 1)->get(['nombre', 'id']);
        $this->dispatchBrowserEvent('reload-select');
        return view('livewire.frontend.grids', [
            'inventarios' => $inventarios,
            'actualCount' => count($inventarios),
            'totalCount' => Inventario::where('estado', 1)->count(),
        ]);
    }
}
