<?php

namespace App\Http\Livewire\Backend;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Talla;
class TallaComponent extends Component
{
    use LivewireAlert;
    public $nombre,$id_talla,$estado;
    protected $listeners = ['resetNamesTal' => 'resetInput','asignTalla' =>'asignTalla','dropByStateTalla' => 'dropByState'];


    protected $rules = [
        'nombre' => 'required|min:1|max:100',
        
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
        $this->reset(['nombre','id_talla','estado']);
    }

    public function asignTalla($talla)
    {
        $this->id_talla = $talla['id_talla'];
        $this->nombre = $talla['nombre'];
        $this->estado = $talla['estado'];
    }

    public function createData()
    {
        $this->validate();
 
        if ($this->id_talla) {
            try {
               
                Talla::where('id',$this->id_talla)->update([
                    'nombre' => $this->nombre,
                    'estado' => $this->estado
                ]);
                session(['alert' => ['type' => 'success', 'message' => 'Talla Actualizada con éxito.','position' =>'center']]); 
                return redirect()->to('/administracion/tallas');
                $this->dispatchBrowserEvent('closeModal'); 
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal'); 
                session(['alert' => ['type' => 'error', 'message' => 'Ocurrio un Error.','position' =>'center']]);
                return redirect()->to('administracion/tallas');
            }
        } else {
            try {
                $talla = new Talla;
                $talla->nombre = $this->nombre;
                $talla->save();
                session(['alert' => ['type' => 'success', 'message' => 'Talla Guardada con éxito.','position' =>'center']]); 
                return redirect()->to('/administracion/tallas');
                $this->dispatchBrowserEvent('closeModal'); 
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal'); 
                session(['alert' => ['type' => 'error', 'message' => 'Ocurrio un Error.','position' =>'center']]);
                return redirect()->to('administracion/tallas');
            }
        }                              
    }
    public function dropByState($id)
    {
        try {
            Talla::where('id',$id)->update(['estado' => 0]);               
            session(['alert' => ['type' => 'success', 'message' => 'Talla desactivada con éxito.']]);
            return redirect()->to('administracion/tallas');
        } catch (\Exception $th) {
           
            $this->alert('error', 'Ocurrió un error porfavor intentelo mas tarde.', [
                'position' => 'center'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.backend.talla-component');
    }
}
