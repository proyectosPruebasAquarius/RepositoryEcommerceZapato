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

class UpdateColorTallaComponent extends Component
{
    use LivewireAlert;
    public 
    $updateColor,
    $oldNameColor,
    $oldColor,
    $detalleColor,
    $tallas = []
    ;
    protected $listeners = ['resetNamesColor' => 'resetInput', 
    'dropColor' => 'dropColor',
     'asignColor' => 'asignColor'
     ,'updateColor' => 'updateColor'    
    ];


    public function asignColor($color)
    {      
        
        $this->updateColor = $color['updateColor'];
        $this->oldNameColor = $color['nombre'];
        $this->oldColor = $color['color'];
        $this->detalleColor = $color['detalle_color'];
        $this->colores = Color::where('estado', 1)->select('nombre', 'id')->get();
        
    }




    public function resetInput()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset(['updateColor', 'oldNameColor', 'oldColor', 'detalleColor']);
    }

    public function updateColor()
    {
        try {
            DetalleColor::where('id',$this->detalleColor)->update([
                'id_color' => $this->updateColor
            ]);
            session(['alert' => ['type' => 'success', 'message' => 'Color Actualizado  con éxito.']]);
            return redirect()->to('administracion/productos');
        } catch (\Throwable $th) {
            $this->alert('error', 'Ocurrió un error porfavor intentelo mas tarde.', [
                'position' => 'center',
            ]);
        }


    }


    public function dropColor($id)
    {
        try {
            DetalleColor::where('id', $id)->delete();
            session(['alert' => ['type' => 'success', 'message' => 'Color eliminado con éxito.']]);
            return redirect()->to('administracion/productos');
        } catch (\Exception $th) {

            $this->alert('error', 'Ocurrió un error porfavor intentelo mas tarde.', [
                'position' => 'center',
            ]);
        }
    }

    public function render()
    {
        
        $this->colores = Color::where('estado', 1)->select('nombre', 'id')->get();
        
        return view('livewire.backend.update-color-talla-component');
    }
}
