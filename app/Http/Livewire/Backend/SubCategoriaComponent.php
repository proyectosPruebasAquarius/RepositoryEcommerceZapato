<?php

namespace App\Http\Livewire\Backend;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\SubCategoria;
class SubCategoriaComponent extends Component
{

    public $nombre;
    public $id_subcategoria;
    public $estado;
    protected $listeners = ['resetNamesSubCat' => 'resetInput','asignSubCategoria' =>'asignCategoria','dropByStateSubCategoria' => 'dropByState'];

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
        $this->reset(['nombre','id_subcategoria']);
    }
    public function asignCategoria($categoria)
    {
        $this->id_subcategoria = $categoria['id_subcategoria'];
        $this->nombre = $categoria['nombre'];
        $this->estado = $categoria['estado'];
    }

    public function createData()
    {
        $this->validate();
 
        if ($this->id_subcategoria) {
            try {
               
                SubCategoria::where('id',$this->id_subcategoria)->update([
                    'nombre' => $this->nombre,
                    'estado' => $this->estado
                ]);
                session(['alert' => ['type' => 'success', 'message' => 'Sub Categoria Actualizada con éxito.','position' =>'center']]); 
                return redirect()->to('/administracion/sub-categorias');
                $this->dispatchBrowserEvent('closeModal'); 
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal'); 
                session(['alert' => ['type' => 'error', 'message' => 'Ocurrio un Error.','position' =>'center']]);
                return redirect()->to('administracion/sub-categorias');
            }
        } else {
            try {
                $categoria = new SubCategoria;
                $categoria->nombre = $this->nombre;
                $categoria->save();
                session(['alert' => ['type' => 'success', 'message' => 'Sub Categoria Guardada con éxito.','position' =>'center']]); 
                return redirect()->to('/administracion/sub-categorias');
                $this->dispatchBrowserEvent('closeModal'); 
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal'); 
                session(['alert' => ['type' => 'error', 'message' => 'Ocurrio un Error.','position' =>'center']]);
                return redirect()->to('administracion/sub-categorias');
            }
        }                              
    }
    public function dropByState($id)
    {
        try {
            SubCategoria::where('id',$id)->update(['estado' => 0]);               
            session(['alert' => ['type' => 'success', 'message' => 'Sub Categoria eliminada con éxito.']]);
            return redirect()->to('administracion/sub-categorias');
        } catch (\Exception $th) {
           
            $this->alert('error', 'Ocurrió un error porfavor intentelo mas tarde.', [
                'position' => 'center'
            ]);
        }
    }




    public function render()
    {
        return view('livewire.backend.sub-categoria-component');
    }
}
