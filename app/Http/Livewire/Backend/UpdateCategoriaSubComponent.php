<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use App\Models\DetalleProducto;
use App\Models\Categoria;
use App\Models\SubCategoria;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class UpdateCategoriaSubComponent extends Component
{
    use LivewireAlert;
    public $oldCategoria,$categoria,$oldSub,$subcat,$detalleProducto,$categorias = [], $sub_categorias = [];

    protected $listeners = ['resetNamesCat' => 'resetInput',
     
     'asignCat' => 'asignCat'
     ,'updateCat' => 'updateCat'
    
    ];
    public function asignCat($cat)
    {
        $this->oldCategoria = $cat['nombre_categoria'];
        $this->detalleProducto = $cat['detalle_producto'];
        $this->oldSub = $cat['nombre_sub'];
        $this->categoria = $cat['id_categoria'];
        $this->subcat = $cat['id_sub'];
    }

    public function resetInput()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset([ 'oldCategoria','detalleProducto','oldSub','categoria','subcat']);
    }
    public function updateCat()
    {
        try {
            DetalleProducto::where('id',$this->detalleProducto)->update([
                'id_categoria' => $this->categoria,
                'id_sub_categoria' => $this->subcat
            ]);
            session(['alert' => ['type' => 'success', 'message' => 'Categoria / Sub Categoria Actualizada con éxito.']]);
            return redirect()->to('administracion/productos');
        } catch (\Throwable $th) {
            $this->alert('error', 'Ocurrió un error porfavor intentelo mas tarde.', [
                'position' => 'center',
            ]);
        }


    }



    public function render()
    {
        $this->categorias = Categoria::where('estado', 1)->select('nombre', 'id')->get();
        $this->sub_categorias = SubCategoria::where('estado', 1)->select('nombre', 'id')->get();
        return view('livewire.backend.update-categoria-sub-component');
    }
}
