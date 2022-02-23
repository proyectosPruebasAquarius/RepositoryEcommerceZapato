<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Inventario;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Details extends Component
{
    use LivewireAlert;
    public $name;
    public $product = array();
    public $count = 0;
    public $style;
    public $size;
    public $qty = 1;
    public $toEdit;

    protected $rules = [
        'style' => 'required',
        'size' => 'required',
        'qty' => 'required',
    ];

    public function addToCart($product)
    {
        try {
            $validate = $this->validate();
            /* $obj = [
                'talla' => $this->size, 
                'color' => $this->style, 
                'qty' => $this->qty,
                'attributes' => array(
                    'image' => $this->product['imagen'],
                    'id_producto' => $this->product['id_producto'],
                    'unid' => 1
                )
            ];
            \Debugbar::info($obj); */
            $showCanvas = false;
            if (\Cart::isEmpty()) {
                if ($this->corroborate($product['id'], $this->qty)) {
                    \Cart::add([
                        'id' => 1,//$product['id'],
                        'name' => $product['nombre'],
                        'price' => $product['precio_descuento'] ? $product['precio_descuento'] : $product['precio_venta'],                        
                        'quantity' => $this->qty,
                        'attributes' => array(
                            'image' => $product['imagen'],
                            'id_producto' => $product['id_producto'],
                            'id_inventario' => $product['id'],
                            'size' => $this->size,
                            'color' => $this->style,
                            'unid' => 1
                        )
                    ]);
                    $showCanvas = true;
                } else {
                    $this->alert('error', 'No está disponible la cantidad deseada para el ítem.', [
                        'position' => 'center',
                        'timer' => 3000,
                        'toast' => true,
                    ]);
                }
            } else {
                //\Debugbar::info(['prueba' => $this->returnId($product)]);
                $isUpdate = $this->returnId($product);
                if ($isUpdate) {
                    $cartV = \Cart::get($isUpdate)->toArray();
                    /* \Debugbar::info(intval($this->qty) + intval($cartV['quantity'])); */
                    if ($this->corroborate($product['id'], intval($this->qty) + intval($cartV['quantity']))) {
                        \Cart::update($isUpdate, array(
                            /* 'quantity' => [
                                'relative' => false,
                                'value' => $this->qty
                            ], */
                            'quantity' => $this->qty                        
                        ));      
                        $showCanvas = true;                  
                    } else {
                        $this->alert('error', 'No está disponible la cantidad deseada para el ítem.', [
                            'position' => 'center',
                            'timer' => 3000,
                            'toast' => true,
                        ]);
                    }
                    $this->reset('toEdit');
                } else {
                    $last = \Cart::getContent()->toArray();
                    sort($last);
                    $lastId = end($last)['id'];

                    if ($this->corroborate($product['id'], $this->qty)) {
                        \Cart::add([
                            'id' => $lastId+1,//$product['id'],
                            'name' => $product['nombre'],
                            'price' => $product['precio_descuento'] ? $product['precio_descuento'] : $product['precio_venta'],                        
                            'quantity' => $this->qty,
                            'attributes' => array(
                                'image' => $product['imagen'],
                                'id_producto' => $product['id_producto'],
                                'id_inventario' => $product['id'],
                                'size' => $this->size,
                                'color' => $this->style,
                                'unid' => 1
                            )
                        ]);
                        $showCanvas = true;
                    } else {
                        $this->alert('error', 'No está disponible la cantidad deseada para el ítem.', [
                            'position' => 'center',
                            'timer' => 3000,
                            'toast' => true,
                        ]);
                    }
                }
            }                   
                    
                    /* \Cart::clear(); */
            $this->emit('cartUpdated');
            if ($showCanvas) {
                $item = \Cart::getContent()->toArray();
                $lastItem = end($item);
                $this->dispatchBrowserEvent('show-canvas', ['data' => $lastItem]); 
            }        
                    /*$this->emit('show', \Cart::get($p['id'])->toArray()); */
                
            
        } catch (\Exception $e) {
           // \Debugbar::info($e->getMessage());
            $message = $e->getMessage() == 'The given data was invalid.' ? 'Seleccione la talla y el color.' : 'Ocurrió un error, por favor intentelo de nuevo.';
            $this->alert('error', $message, [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
        }
    }

    public function corroborate($id, $qty) 
    {
        $stock = Inventario::where('id', $id)->value('stock');

        if ($qty <= $stock) {
            return true;
        } else {
            return false;
        }
    }

    public function returnId($p)
    {
        $cart = \Cart::getContent();
        $data = ["talla" => $this->size, "color" => $this->style, 'id_inventario' => $p['id']];
        /* $cart->where('name', $p['nombre'])->all();
        $multiplied = $cart->map(function ($item, $key) use ($data){
            if ($item->attributes->size ===  $data['talla'] && $item->attributes->color === $data['color'] && $item->attributes->id_inventario === $data['id_inventario']) {
                return $item->id;
            }
        }); */

        /* foreach ($cart as $item) {
            if ($item->attributes->size ==  $this->size && $item->attributes->color == $this->style && $item->attributes->id_inventario == $p['id']) {
                return $item->id;
            } else {
                \Cart::add([
                    'id' => $this->count+1,
                    'name' => $p['nombre'],
                    'price' => $p['precio_descuento'] ? $p['precio_descuento'] : $p['precio_venta'],                        
                    'quantity' => $this->qty,
                    'attributes' => array(
                        'image' => $p['imagen'],
                        'id_producto' => $p['id_producto'],
                        'id_inventario' => $p['id'],
                        'size' => $this->size,
                        'color' => $this->style,
                        'unid' => 1
                    )
                ]);
            }
        } */
        $test = $cart->map(function ($item, $key) use ($p) {
            if ($item->attributes->size ==  $this->size && $item->attributes->color == $this->style && $item->attributes->id_inventario == $p['id']) {
                $this->toEdit = $item->id;
                return $item->id;
            }
        });
        //\Debugbar::info(['la merara' => $this->toEdit]);
        return $this->toEdit;
    }
    
    public function render()
    {
        $this->product = Inventario::join('productos', 'inventarios.id_producto', '=', 'productos.id')
        ->join('detalles_productos', 'productos.id_detalle_producto', '=', 'detalles_productos.id')
        ->join('categorias', 'detalles_productos.id_categoria', '=', 'categorias.id')
        ->join('sub_categorias', 'detalles_productos.id_sub_categoria', '=', 'sub_categorias.id')
        ->where('productos.nombre', $this->name)
        ->select('inventarios.*', 'productos.id_detalle_producto', 'productos.nombre', 'productos.cod', 'productos.imagen', 'productos.descripcion', 'productos.id as producto_id', 
        'detalles_productos.id_categoria', 'detalles_productos.id_sub_categoria', 'categorias.nombre as categoria', 'categorias.id as categoria_id', 'sub_categorias.nombre as sub_categoria', 'sub_categorias.id as sub_categoria_id')
        ->first();

        return view('livewire.frontend.details');
    }
}
