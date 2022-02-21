<?php

namespace App\Http\Livewire\Backend;

use App\Models\Categoria;
use App\Models\Color;
use App\Models\DetalleColor;
use App\Models\DetalleProducto;
use App\Models\DetalleTalla;
use App\Models\SubCategoria;
use App\Models\Talla;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class UpdateTallaComponent extends Component
{
    use LivewireAlert;
    public 
    $updateTalla,
    $oldTalla,
    $detalleTalla,    
    $tallas = []
    ;
    protected $listeners = ['resetNamesTalla' => 'resetInput',
     'dropTalla' => 'dropTalla',
     'asignTalla' => 'asignTalla'
     ,'updateTalla' => 'updateTalla'
    
    ];


    
    public function asignTalla($talla)
    {
        $this->oldTalla = $talla['nombre'];
        $this->detalleTalla = $talla['detalle_talla'];
        $this->updateTalla = $talla['id_talla'];
    }

    public function resetInput()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset([ 'updateTalla','oldTalla','detalleTalla']);
    }

    public function updateTalla()
    {
        try {
            DetalleTalla::where('id',$this->detalleTalla)->update([
                'id_talla' => $this->updateTalla
            ]);
            session(['alert' => ['type' => 'success', 'message' => 'Talla Actualizada con éxito.']]);
            return redirect()->to('administracion/productos');
        } catch (\Throwable $th) {
            $this->alert('error', 'Ocurrió un error porfavor intentelo mas tarde.', [
                'position' => 'center',
            ]);
        }


    }


    public function dropTalla($id)
    {
        try {
            DetalleTalla::where('id', $id)->delete();
            session(['alert' => ['type' => 'success', 'message' => 'Talla eliminado con éxito.']]);
            return redirect()->to('administracion/productos');
        } catch (\Exception $th) {

            $this->alert('error', 'Ocurrió un error porfavor intentelo mas tarde.', [
                'position' => 'center',
            ]);
        }
    }







    public function render()
    {
        $this->tallas = Talla::where('estado', 1)->select('nombre', 'id')->get();
        return view('livewire.backend.update-talla-component');
    }
}
