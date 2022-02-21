<?php

namespace App\Http\Livewire\Backend;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Marca;
class MarcaComponent extends Component
{
    use LivewireAlert;
    public $nombre,$id_marca,$estado;
    protected $listeners = ['resetNamesMarca' => 'resetInput','asignMarca' =>'asignMarca','dropByStateMarca' => 'dropByState'];


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
        $this->reset(['nombre','id_marca','estado']);
    }

    public function asignMarca($marca)
    {
        $this->id_marca = $marca['id_marca'];
        $this->nombre = $marca['nombre'];
        $this->estado = $marca['estado'];
    }

    public function createData()
    {
        $this->validate();
 
        if ($this->id_marca) {
            try {
               
                Marca::where('id',$this->id_marca)->update([
                    'nombre' => $this->nombre,
                    'estado' => $this->estado
                ]);
                session(['alert' => ['type' => 'success', 'message' => 'Marca Actualizada con éxito.','position' =>'center']]); 
                return redirect()->to('/administracion/marcas');
                $this->dispatchBrowserEvent('closeModal'); 
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal'); 
                session(['alert' => ['type' => 'error', 'message' => 'Ocurrio un Error.','position' =>'center']]);
                return redirect()->to('administracion/marcas');
            }
        } else {
            try {
                $marca = new Marca;
                $marca->nombre = $this->nombre;
                $marca->save();
                session(['alert' => ['type' => 'success', 'message' => 'Marca Guardada con éxito.','position' =>'center']]); 
                return redirect()->to('/administracion/marcas');
                $this->dispatchBrowserEvent('closeModal'); 
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal'); 
                session(['alert' => ['type' => 'error', 'message' => 'Ocurrio un Error.','position' =>'center']]);
                return redirect()->to('administracion/marcas');
            }
        }                              
    }
    public function dropByState($id)
    {
        try {
            Marca::where('id',$id)->update(['estado' => 0]);               
            session(['alert' => ['type' => 'success', 'message' => 'Marca desactivada con éxito.']]);
            return redirect()->to('administracion/marcas');
        } catch (\Exception $th) {
           
            $this->alert('error', 'Ocurrió un error porfavor intentelo mas tarde.', [
                'position' => 'center'
            ]);
        }
    }


    public function render()
    {
        return view('livewire.backend.marca-component');
    }
}
