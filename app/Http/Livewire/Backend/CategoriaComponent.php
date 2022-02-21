<?php

namespace App\Http\Livewire\Backend;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Categoria;

class CategoriaComponent extends Component
{
    use LivewireAlert;


    public $nombre;
    public $id_categoria;
    public $estado;
    protected $listeners = ['resetNamesCat' => 'resetInput','asignCategoria' =>'asignCategoria','dropByStateCategoria' => 'dropByState'];

    protected $rules = [
        'nombre' => 'required|min:4|max:100',
        
    ];
    protected $messages =[
        'nombre.required' => 'El Nombre es Obligatorio',
        'nombre.min' => 'El Nombre debe contener un mínimo de :min caracteres',
        'nombre.max' => 'El Nombre debe contener un máximo de :max caracteres'
    ];
   

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetInput()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset(['nombre','id_categoria','estado']);
    }
    public function asignCategoria($categoria)
    {
        $this->id_categoria = $categoria['id_categoria'];
        $this->nombre = $categoria['nombre'];
        $this->estado = $categoria['estado'];
    }

    public function createData()
    {
        $this->validate();
 
        if ($this->id_categoria) {
            try {
               
                Categoria::where('id',$this->id_categoria)->update([
                    'nombre' => $this->nombre,
                    'estado' => $this->estado
                ]);
                session(['alert' => ['type' => 'success', 'message' => 'Categoria Actualizada con éxito.','position' =>'center']]); 
                return redirect()->to('/administracion/categorias');
                $this->dispatchBrowserEvent('closeModal'); 
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal'); 
                session(['alert' => ['type' => 'error', 'message' => 'Ocurrio un Error.','position' =>'center']]);
                return redirect()->to('administracion/categorias');
            }
        } else {
            try {
                $categoria = new Categoria;
                $categoria->nombre = $this->nombre;
                $categoria->save();
                session(['alert' => ['type' => 'success', 'message' => 'Categoria Guardada con éxito.','position' =>'center']]); 
                return redirect()->to('/administracion/categorias');
                $this->dispatchBrowserEvent('closeModal'); 
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal'); 
                session(['alert' => ['type' => 'error', 'message' => 'Ocurrio un Error.','position' =>'center']]);
                return redirect()->to('administracion/categorias');
            }
        }                              
    }
    public function dropByState($id)
    {
        try {
            Categoria::where('id',$id)->update(['estado' => 0]);               
            session(['alert' => ['type' => 'success', 'message' => 'Categoria eliminada con éxito.']]);
            return redirect()->to('administracion/categorias');
        } catch (\Exception $th) {
           
            $this->alert('error', 'Ocurrió un error porfavor intentelo mas tarde.', [
                'position' => 'center'
            ]);
        }
    }


    public function render()
    {
        return view('livewire.backend.categoria-component');
    }
}
