<?php

namespace App\Http\Livewire\Backend;

use App\Models\MetodoPago;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use File;
class MetodoPagoComponent extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    public $id_metodo, $nombre, $numero, $qr = [], $estado, $asociado, $oldImg;
    protected $listeners = ['resetNamesMetodo' => 'resetInput', 'asignMetodo' => 'asignMetodo', 'dropByStateMetodo' => 'dropByState'];
    protected $rules = [

        /*'qr' => ['required'],
        'qr.*' =>['image','mimes:jpeg,png,jpg,gif,svg'],*/
        'nombre' => ['required', 'max:100'],
        'numero' => ['required'],
        'asociado' => ['required'],
    ];

    protected $messages = [
        'nombre.required' => 'El nombre de Tipo de pago es Obligatorio.',
        'nombre.max' => 'El nombre de Tipo de pago no puede ser mayor a :max caracteres.',
        'asociado.required' => 'Nombre del Asociado a la Cuenta es Obligatorio',
        'numero.required' => 'Número de Cuenta Bancaria, Célular o Bitcoin es Obligatorio.',
        'qr.required' => 'La Imagen QR es Obligatoria',
        'qr.*.mimes' => 'Formato de Imagen no Valido',
        'qr.*.image' => 'Debe ser una Imagen',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetInput()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset(['nombre', 'id_metodo', 'estado', 'qr', 'numero', 'asociado']);
    }

    public function asignMetodo($metodo)
    {
        $this->id_metodo = $metodo['id_metodo'];
        $this->nombre = $metodo['nombre'];
        $this->estado = $metodo['estado'];       
        $this->oldImg = $metodo['qr'];               
        $this->asociado = $metodo['cuenta_asociado'];
        $this->numero = $metodo['numero'];
    }

    public function createData()
    {
       
        if ($this->oldImg != null) {
            $this->rules = [
               
                'nombre' => ['required', 'max:100'],
                'numero' => ['required'],
                'asociado' => ['required'],
            ];
        } else {
            $this->rules = [
                'qr' => ['required'],
                'qr.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
                'nombre' => ['required', 'max:100'],
                'numero' => ['required'],
                'asociado' => ['required'],
            ];
        }
        
        $this->validate();
        
        if ($this->id_metodo) {
            try {
                if (sizeof($this->qr) === 0) {
                    MetodoPago::where('id', $this->id_metodo)->update([
                        'nombre' => $this->nombre,
                        'estado' => $this->estado,
                        'numero' => $this->numero,
                        'cuenta_asociado' => $this->asociado,
    
                    ]);
                   
                    
                }else {
                   /* foreach(json_decode($this->oldImg) as $img) {
                        $image_path = public_path("storage/images/metodos_pagos/".$img);
                        if (file_exists($image_path)) {
                                File::delete($image_path);
                        }
                    }*/
                    $numItems = count($this->qr);
                    $i = 0;
                    foreach ($this->qr as $photo) {
                        $extension = $photo->extension();
                        $imageName = hash('sha1', $photo);
                        $imgComplete = $imageName . '.' . $extension;
    
                        $photo->storeAs('images/metodos_pagos', $imgComplete, 'public');
                       
                        $data[] = $imgComplete;
                        if (++$i === $numItems) {
                            MetodoPago::where('id', $this->id_metodo)->update([
                                'nombre' => $this->nombre,
                                'estado' => $this->estado,
                                'numero' => $this->numero,
                                'cuenta_asociado' => $this->asociado,
                                'qr' => json_encode($data)
                            ]);                              
                        }
                    }
                }
               
                session(['alert' => ['type' => 'success', 'message' => 'Método de Pago Actualizado con éxito.', 'position' => 'center']]);
                return redirect()->to('/administracion/metodos-pagos');
                $this->dispatchBrowserEvent('closeModal');
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal');
                session(['alert' => ['type' => 'error', 'message' => $th->getMessage(), 'position' => 'center']]);
                return redirect()->to('administracion/metodos-pagos');
            }
        } else {

            try {

                $metodo = new MetodoPago;
                $metodo->nombre = $this->nombre;
                $metodo->numero = $this->numero;
                $metodo->cuenta_asociado = $this->asociado;
                $numItems = count($this->qr);
                $i = 0;
                foreach ($this->qr as $photo) {
                    $extension = $photo->extension();
                    $imageName = hash('sha1', $photo);
                    $imgComplete = $imageName . '.' . $extension;

                    $photo->storeAs('images/metodos_pagos', $imgComplete, 'public');
                   
                    $data[] = $imgComplete;
                    if (++$i === $numItems) {
                        $metodo->qr = json_encode($data);
                        $metodo->save();

                    }
                }
                session(['alert' => ['type' => 'success', 'message' => 'Método de Pago Guardado con éxito.', 'position' => 'center']]);
                return redirect()->to('/administracion/metodos-pagos');
                $this->dispatchBrowserEvent('closeModal');
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal');
                session(['alert' => ['type' => 'error', 'message' => $th->getMessage(), 'position' => 'center']]);
                return redirect()->to('administracion/metodos-pagos');
            }
        }
    }

    public function dropByState($id)
    {
        try {
            MetodoPago::where('id', $id)->update(['estado' => 0]);
            session(['alert' => ['type' => 'success', 'message' => 'Metodo de Pago desactivado con éxito.']]);
            return redirect()->to('administracion/metodos-pagos');
        } catch (\Exception $th) {

            $this->alert('error', 'Ocurrió un error porfavor intentelo mas tarde.', [
                'position' => 'center',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.backend.metodo-pago-component');
    }
}
