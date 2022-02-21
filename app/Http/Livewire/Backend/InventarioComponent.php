<?php

namespace App\Http\Livewire\Backend;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Inventario;
use App\Models\Oferta;
use App\Models\Producto;
class InventarioComponent extends Component
{
    use LivewireAlert;

    public $id_inventario, $precio_compra, $precio_venta, $precio_descuento, $stock, $stock_min, $producto, $descuento, $descuentos = [], $productos = [],$estado;

    protected $listeners = ['resetNamesInventario' => 'resetInput', 'asignInventario' => 'asignInventario', 'dropByStateInventario' => 'dropByState'];

    protected $rules = [

        'stock' => ['required', 'numeric'],
        'stock_min' => ['required', 'numeric'],
        'precio_compra' => ['required', 'regex:/^(?:[1-9]\d+|\d)(?:\.\d\d)?$/'],
        'precio_venta' => ['required', 'regex:/^(?:[1-9]\d+|\d)(?:\.\d\d)?$/'],
        'producto' => 'required',

    ];

    protected $messages = [

        'stock.required' => 'EL Stock del Producto es Obligatorio.',
        'stock.numeric' => 'EL Stock del Producto deben ser caracteres numerícos.',
        'stock_min.required' => 'EL Stock Minímo del Producto es Obligatorio.',
        'stock_min.numeric' => 'EL Stock Minímo del Producto deben ser caracteres numerícos.',
        'precio_compra.required' => 'El Precio de Compra es Obligatorio.',
        'precio_compra.regex' => 'El formato del Precio de Compra es inválido.',
        'precio_venta.regex' => 'El formato del Precio de Compra es inválido.',
        'precio_venta.required' => 'El Precio de Venta es Obligatorio.',
        'producto.required' => 'El Producto es Obligatorio.',

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetInput()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset(['id_inventario','precio_compra','precio_venta','precio_descuento','stock','stock_min','producto','descuento']);
    }

    public function asignInventario($inventario)
    {
        $this->id_inventario = $inventario['id_inventario'];
        $this->precio_compra = $inventario['precio_compra'];
        $this->precio_venta = $inventario['precio_venta'];
        $this->stock = $inventario['stock'];
        $this->stock_min = $inventario['min_stock'];
        $this->producto = $inventario['producto'];
        $this->descuento = $inventario['descuento'];
        $this->estado = $inventario['estado'];
    }

    public function createData()
    {
        $this->validate();
      
        $descuento = NULL;
        if ($this->id_inventario) {
            try {
                $inventario = Inventario::where('id','=',$this->id_inventario)->first(); 

                $inventario->precio_compra = $this->precio_compra;
                $inventario->precio_venta = $this->precio_venta;
                
                $inventario->stock = $this->stock;
                $inventario->id_producto = $this->producto;
                
                $inventario->min_stock = $this->stock_min;
                if ($this->descuento != 0) {
                    $oferta = Oferta::select('nombre')->where('id', '=', $this->descuento)->get();
                    $descuento = $oferta[0]->nombre;
                    function porcentaje($cantidad,$porciento,$decimales){
                        return number_format($cantidad*$porciento/100 ,$decimales);
                        }
                    $porciento =  porcentaje($this->precio_venta,intval($descuento),2);
                    $inventario->precio_descuento = $this->precio_venta - $porciento;
                }else{
                    $inventario->id_oferta = null;
                    $inventario->precio_descuento = null;
                }                                
                $inventario->save();
                session(['alert' => ['type' => 'success', 'message' => 'Inventario Actualizado con éxito.','position' =>'center']]); 
                return redirect()->to('/administracion/inventarios');
                $this->dispatchBrowserEvent('closeModal'); 
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal'); 
                session(['alert' => ['type' => 'error', 'message' => $th->getMessage(),'position' =>'center']]);
                return redirect()->to('administracion/inventarios');
            }
        } else {
            
        




            try {
                

                $inventario = new Inventario;
                $inventario->precio_compra = $this->precio_compra;
                $inventario->precio_venta = $this->precio_venta;
                
                $inventario->stock = $this->stock;
                $inventario->id_producto = $this->producto;
                
                $inventario->min_stock = $this->stock_min;
                if ($this->descuento != 0) {
                    $inventario->id_oferta = $this->descuento;
                    $oferta = Oferta::select('nombre')->where('id', '=', $this->descuento)->get();
                    $descuento = $oferta[0]->nombre;
                    function porcentaje($cantidad,$porciento,$decimales){
                        return number_format($cantidad*$porciento/100 ,$decimales);
                        }
                    $porciento =  porcentaje($this->precio_venta,intval($descuento),2);
                    $inventario->precio_descuento = $this->precio_venta - $porciento;
                }                                
                $inventario->save();

                session(['alert' => ['type' => 'success', 'message' => 'Inventario Guardado con éxito.','position' =>'center']]); 
                return redirect()->to('/administracion/inventarios');
                $this->dispatchBrowserEvent('closeModal'); 
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal'); 
                session(['alert' => ['type' => 'error', 'message' => $th->getMessage(),'position' =>'center']]);
                return redirect()->to('administracion/inventarios');
            }
        }                              
    }
    public function dropByState($id)
    {
        try {
            Inventario::where('id',$id)->update(['estado' => 0]);               
            session(['alert' => ['type' => 'success', 'message' => 'Inventario desactivado con éxito.']]);
            return redirect()->to('administracion/inventarios');
        } catch (\Exception $th) {
           
            $this->alert('error', 'Ocurrió un error porfavor intentelo mas tarde.', [
                'position' => 'center'
            ]);
        }
    }

    public function render()
    {
        $productsUsed = Inventario::where('estado',1)->select('id_producto')->get();
        $this->productos = Producto::where('estado',1)->select('id','cod')->whereNotIn('id',$productsUsed)->get();
        $this->ofertas = Oferta::where('estado',1)->select('nombre','id')->get();
        return view('livewire.backend.inventario-component');
    }
}
