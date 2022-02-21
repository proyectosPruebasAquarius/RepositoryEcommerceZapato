<?php

namespace App\Http\Livewire\Backend;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Oferta;
class OfertaComponent extends Component
{
    use LivewireAlert;
    public $nombre,$id_oferta,$estado;
    protected $listeners = ['resetNamesOferta' => 'resetInput','asignOferta' =>'asignOferta','dropByStateOferta' => 'dropByState'];


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
        $this->reset(['nombre','id_oferta','estado']);
    }

    public function asignOferta($oferta)
    {
        $this->id_oferta = $oferta['id_oferta'];
        $this->nombre = $oferta['nombre'];
        $this->estado = $oferta['estado'];
    }

    public function createData()
    {
        $this->validate();
 
        if ($this->id_oferta) {
            try {
               
                Oferta::where('id',$this->id_oferta)->update([
                    'nombre' => $this->nombre,
                    'estado' => $this->estado
                ]);
                session(['alert' => ['type' => 'success', 'message' => 'Oferta Actualizada con éxito.','position' =>'center']]); 
                return redirect()->to('/administracion/ofertas');
                $this->dispatchBrowserEvent('closeModal'); 
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal'); 
                session(['alert' => ['type' => 'error', 'message' => 'Ocurrio un Error.','position' =>'center']]);
                return redirect()->to('administracion/ofertas');
            }
        } else {
            try {
                $oferta = new Oferta;
                $oferta->nombre = $this->nombre;
                $oferta->save();
                session(['alert' => ['type' => 'success', 'message' => 'Oferta Guardada con éxito.','position' =>'center']]); 
                return redirect()->to('/administracion/ofertas');
                $this->dispatchBrowserEvent('closeModal'); 
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal'); 
                session(['alert' => ['type' => 'error', 'message' => 'Ocurrio un Error.','position' =>'center']]);
                return redirect()->to('administracion/ofertas');
            }
        }                              
    }
    public function dropByState($id)
    {
        try {
            Oferta::where('id',$id)->update(['estado' => 0]);               
            session(['alert' => ['type' => 'success', 'message' => 'Oferta desactivada con éxito.']]);
            return redirect()->to('administracion/ofertas');
        } catch (\Exception $th) {
           
            $this->alert('error', 'Ocurrió un error porfavor intentelo mas tarde.', [
                'position' => 'center'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.backend.oferta-component');
    }
}
