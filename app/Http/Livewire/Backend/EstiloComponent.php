<?php

namespace App\Http\Livewire\Backend;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Estilo;
class EstiloComponent extends Component
{
    use LivewireAlert;
    public $nombre,$id_estilo,$estado;
    protected $listeners = ['resetNamesEstilo' => 'resetInput','asignEstilo' =>'asignEstilo','dropByStateEstilo' => 'dropByState'];


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
        $this->reset(['nombre','id_estilo','estado']);
    }

    public function asignEstilo($estilo)
    {
        $this->id_estilo = $estilo['id_estilo'];
        $this->nombre = $estilo['nombre'];
        $this->estado = $estilo['estado'];
    }

    public function createData()
    {
        $this->validate();
 
        if ($this->id_estilo) {
            try {
               
                Estilo::where('id',$this->id_estilo)->update([
                    'nombre' => $this->nombre,
                    'estado' => $this->estado
                ]);
                session(['alert' => ['type' => 'success', 'message' => 'Estilo Actualizado con éxito.','position' =>'center']]); 
                return redirect()->to('/administracion/estilos');
                $this->dispatchBrowserEvent('closeModal'); 
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal'); 
                session(['alert' => ['type' => 'error', 'message' => 'Ocurrio un Error.','position' =>'center']]);
                return redirect()->to('administracion/estilos');
            }
        } else {
            try {
                $estilo = new Estilo;
                $estilo->nombre = $this->nombre;
                $estilo->save();
                session(['alert' => ['type' => 'success', 'message' => 'Estilo Guardado con éxito.','position' =>'center']]); 
                return redirect()->to('/administracion/estilos');
                $this->dispatchBrowserEvent('closeModal'); 
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal'); 
                session(['alert' => ['type' => 'error', 'message' => 'Ocurrio un Error.','position' =>'center']]);
                return redirect()->to('administracion/estilos');
            }
        }                              
    }
    public function dropByState($id)
    {
        try {
            Estilo::where('id',$id)->update(['estado' => 0]);               
            session(['alert' => ['type' => 'success', 'message' => 'Estilo desactivado con éxito.']]);
            return redirect()->to('administracion/estilos');
        } catch (\Exception $th) {
           
            $this->alert('error', 'Ocurrió un error porfavor intentelo mas tarde.', [
                'position' => 'center'
            ]);
        }
    }
    public function render()
    {
        return view('livewire.backend.estilo-component');
    }
}
