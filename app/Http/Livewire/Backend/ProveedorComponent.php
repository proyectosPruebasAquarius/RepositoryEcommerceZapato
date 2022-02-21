<?php

namespace App\Http\Livewire\Backend;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Proveedor;
class ProveedorComponent extends Component
{
    use LivewireAlert;
    public $nombre,$direccion,$telefono,$contacto,$telcontacto,$estado,$id_proveedor;
    protected $listeners = ['resetNamesProveedor' => 'resetInput','asignProveedor' =>'asignProveedor','dropByStateProveedor' => 'dropByState'];
    protected $rules = [
            
        'nombre' => ['required','max:200'],
        'direccion' => ['required','max:500'],
        'telefono' => ['required','numeric'],
        'contacto' => ['required'],
        'telcontacto' => ['required','numeric'],
        
    ];
    
    protected $messages = [
        'contacto.required' => 'Nombre del Contacto es Obligatorio.',
        'contacto.max' =>'El nombre del Proveedor no puede ser mayor a :max caracteres.',
        'nombre.required' => 'Nombre del Proveedor es Obligatorio.',
        'nombre.max' =>'El nombre del Proveedor no puede ser mayor a :max caracteres.',
        'direccion.required' => 'La Dirección del Proveedor es Obligatoria.',
        'direccion.max' =>'La Dirección del Proveedor no puede ser mayor a :max caracteres.',
        'telefono.required' => 'El Numeró de Teléfono del Proveedor es Obligatorio.',
        'telefono.numeric' => 'El Numeró de Teléfono del Proveedor debe ser un número',
        'telcontacto.required' => 'El Numeró de Teléfono del Contacto es Obligatorio.',
        'telcontacto.numeric' => 'El Numeró de Teléfono del Contacto debe ser un número',
        
    ];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetInput()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset(['nombre','id_proveedor','estado','direccion','telefono','contacto','telcontacto']);
    }

    public function asignProveedor($proveedor)
    {
        $this->id_proveedor = $proveedor['id_proveedor'];
        $this->nombre = $proveedor['nombre'];
        $this->telefono = $proveedor['telefono'];
        $this->direccion = $proveedor['direccion'];
        $this->contacto = $proveedor['nombre_contacto'];
        $this->telcontacto = $proveedor['tel_contacto'];
        $this->estado = $proveedor['estado'];
    }

    public function createData()
    {
        $this->validate();
 
        if ($this->id_proveedor) {
            try {
               
                Proveedor::where('id',$this->id_proveedor)->update([
                    'nombre' => $this->nombre,
                    'estado' => $this->estado,
                    'direccion' => $this->direccion,
                    'nombre_contacto' => $this->contacto,
                    'telefono' => $this->telefono,
                    'tel_contacto' => $this->telcontacto
                ]);
                session(['alert' => ['type' => 'success', 'message' => 'Proveedor Actualizado con éxito.','position' =>'center']]); 
                return redirect()->to('/administracion/proveedores');
                $this->dispatchBrowserEvent('closeModal'); 
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal'); 
                session(['alert' => ['type' => 'error', 'message' => 'Ocurrio un Error.','position' =>'center']]);
                return redirect()->to('administracion/proveedores');
            }
        } else {
            try {
                $proveedor = new Proveedor;
                $proveedor->nombre = $this->nombre;
                $proveedor->direccion = $this->direccion;
                $proveedor->nombre_contacto = $this->contacto;
                $proveedor->telefono = $this->telefono;
                $proveedor->tel_contacto = $this->telcontacto;

                $proveedor->save();
                session(['alert' => ['type' => 'success', 'message' => 'Proveedor Guardado con éxito.','position' =>'center']]); 
                return redirect()->to('/administracion/proveedores');
                $this->dispatchBrowserEvent('closeModal'); 
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal'); 
                session(['alert' => ['type' => 'error', 'message' => 'Ocurrio un Error.','position' =>'center']]);
                return redirect()->to('administracion/proveedores');
            }
        }                              
    }
    public function dropByState($id)
    {
        try {
            Proveedor::where('id',$id)->update(['estado' => 0]);               
            session(['alert' => ['type' => 'success', 'message' => 'Proveedor desactivado con éxito.']]);
            return redirect()->to('administracion/proveedores');
        } catch (\Exception $th) {
           
            $this->alert('error', 'Ocurrió un error porfavor intentelo mas tarde.', [
                'position' => 'center'
            ]);
        }
    }



    public function render()
    {
        return view('livewire.backend.proveedor-component');
    }
}
