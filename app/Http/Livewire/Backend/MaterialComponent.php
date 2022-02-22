<?php

namespace App\Http\Livewire\Backend;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Material;
class MaterialComponent extends Component
{
    use LivewireAlert;
    public $nombre,$id_material,$estado,$oldestado;
    protected $listeners = ['resetNamesMaterial' => 'resetInput','asignMaterial' =>'asignMaterial','dropByStateMaterial' => 'dropByState'];

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
        $this->reset(['nombre','id_material','estado']);
    }

    public function asignMaterial($material)
    {
        $this->id_material = $material['id_material'];
        $this->nombre = $material['nombre'];
        $this->oldestado = $material['estado'];
    }


    public function createData()
    {
        $this->validate();
 
        if ($this->id_material) {
            try {
               
                Material::where('id',$this->id_material)->update([
                    'nombre' => $this->nombre,
                    'estado' => $this->estado
                ]);
                session(['alert' => ['type' => 'success', 'message' => 'Material Actualizado con éxito.','position' =>'center']]); 
                return redirect()->to('/administracion/materiales');
                $this->dispatchBrowserEvent('closeModal'); 
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal'); 
                session(['alert' => ['type' => 'error', 'message' => 'Ocurrio un Error.','position' =>'center']]);
                return redirect()->to('administracion/materiales');
            }
        } else {
            try {
                $material = new Material;
                $material->nombre = $this->nombre;
                $material->save();
                session(['alert' => ['type' => 'success', 'message' => 'Material Guardado con éxito.','position' =>'center']]); 
                return redirect()->to('/administracion/materiales');
                $this->dispatchBrowserEvent('closeModal'); 
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal'); 
                session(['alert' => ['type' => 'error', 'message' => $th->getMessage(),'position' =>'center']]);
                return redirect()->to('administracion/materiales');
            }
        }                              
    }
    public function dropByState($id)
    {
        try {
            Material::where('id',$id)->update(['estado' => 0]);               
            session(['alert' => ['type' => 'success', 'message' => 'Material desactivado con éxito.']]);
            return redirect()->to('administracion/materiales');
        } catch (\Exception $th) {
           
            $this->alert('error', 'Ocurrió un error porfavor intentelo mas tarde.', [
                'position' => 'center'
            ]);
        }
    }





    public function render()
    {
        return view('livewire.backend.material-component');
    }
}
