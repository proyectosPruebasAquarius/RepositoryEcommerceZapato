<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Direccion;
use App\Models\DireccionFacturaccion;
use App\Models\Departamento;
use App\Models\Municipio;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Direcciones extends Component
{
    use LivewireAlert;
    public $isFacturacion = false;
    public $idDireccion;
    public $direccion;
    public $referencia;
    public $id_municipio;
    public $idDepartamento;

    //arrays
    public $departamentos = array();
    public $municipios = array();

    protected $listeners = ['cleanDirecciones' => 'clean', 'setValuesD' => 'assignValue', 'setIsFacturacion' => 'setIsFacturacion', 'trashD' => 'trash'];
    protected $rules = [
        'direccion' => 'required|string|min:4|max:500',
        'referencia' => 'nullable|string|min:4|max:500',
        'id_municipio' => 'required',
        'idDepartamento' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedIdDepartamento()
    {
        $this->setMunicipio();
    }
    /* public function hydrateIdMunicipio()
    {
        $this->dispatchBrowserEvent('contentChanged');
    } */

    public function createOrUpdate()
    {
        $validatedData = $this->validate();
        $validatedData['id_user'] = auth()->user()->id;
        $id = $this->idDireccion;

        try {
            /* Direccion::updateOrCreate([
                ['id' => $id],
                ['direccion' => $validatedData['direccion'], 'referencia' => $validatedData['referencia'], 'id_municipio' => $validatedData['id_municipio'], 'id_user' => $validatedData['id_user']]]); */
            if ($this->isFacturacion) {
                if ($id) {
                    $direccion = DireccionFacturaccion::findOrFail($id);
                    $direccion->update($validatedData);
                    return redirect()->to('/perfil');
                } else {
                    DireccionFacturaccion::create($validatedData);
                    return redirect()->to('/perfil');
                }
            } else {
                if ($id) {
                    $direccion = Direccion::findOrFail($id);
                    $direccion->update($validatedData);
                    return redirect()->to('/perfil');
                } else {
                    Direccion::create($validatedData);
                    return redirect()->to('/perfil');
                }
            }
            
        } catch (\Exception $e) {
            //throw $th;
            $this->dispatchBrowserEvent('close-modal');

            $this->alert('error', 'Ocurrió un error inesperado, por favor intentelo mas tarde.', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
            /* \Debugbar::info($e->getMessage()); */
        }
    }

    public function mount()
    {
        // Function default mount de livewire. Montando los departamentos
        $this->departamentos = Departamento::get(['nombre', 'id']);        
    }

    public function clean()
    {
        // Limpia los campos y los errores
        $this->resetErrorBag();

        $this->resetValidation();

        $this->reset(['idDireccion', 'direccion', 'referencia', 'id_municipio', 'idDepartamento', 'isFacturacion']);
    }

    public function assignValue($items)
    {
        // Asigna los valores enviados por el cliente
        $this->idDireccion= $items['id'];
        $this->direccion= $items['direccion'];
        $this->referencia= $items['referencia'];
        $this->idDepartamento= $items['id_departamento'];
        $this->setMunicipio();
        $this->id_municipio= $items['id_municipio'];        
    }

    public function setMunicipio()
    {
        // Obtiene el valor de municipios y asigna para actualizar o agregar segun el departamento escogido.
        $this->municipios = Municipio::where('id_departamento', '=', $this->idDepartamento)->get(['nombre', 'id', 'id_departamento']);
    }

    public function setIsFacturacion()
    {
        $this->isFacturacion = true;
    }

    public function trash($id)
    {
        try {
            if ($this->isFacturacion) {
                DireccionFacturaccion::findOrFail($id)->delete();
                return redirect()->to('/perfil');
            } else {
                Direccion::findOrFail($id)->delete();
                return redirect()->to('/perfil');
            }
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('close-modal');

            $this->alert('error', 'Ocurrió un error inesperado, por favor intentelo mas tarde.', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.frontend.direcciones');
    }
}
