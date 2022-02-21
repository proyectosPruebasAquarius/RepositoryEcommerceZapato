<?php

namespace App\Http\Livewire\Backend;

use App\Models\DetalleVenta;
use App\Models\Venta;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ManualVentaComponent extends Component
{
    use LivewireAlert;
    public $id_venta, $detalle_venta = [], $estado, $productosVenta = [], $descuento, $productos = [];
    protected $listeners = ['detalleVentaManual' => 'detalleVentaManual', 'manualupd' => 'manualupd'];

    protected $rules = [

        'descuento' => ['required', 'numeric', 'regex:/^(?:[1-9]\d+|\d)(?:\.\d\d)?$/'],

        'productos' => 'required',

    ];

    protected $messages = [
        'descuento.required' => 'El descuento es Obligatorio',
        'descuento.numeric' => 'El descuento debe ser un numero',
        'descuento.regex' => 'El formato del descuento no es inválido.',
        'productos.required' => 'Seleccione el producto/s para descontar',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function detalleVentaManual($id)
    {
        $this->dispatchBrowserEvent('reloadT');
       $this->id_venta = $id;

    }
    public function manualupd($id)
    {
        $this->validate();

        $venta = Venta::where('id', '=', $id)->get();
        //$productos = $this->producto;

        if ($this->productos == null) {

            session(['alert' => ['type' => 'warning', 'message' => 'Debe selecionar el producto a descontar.', 'position' => 'center']]);
            return redirect()->to('/administracion/ventas');
            $this->dispatchBrowserEvent('closeModal');
        } elseif ($this->descuento == null) {

            session(['alert' => ['type' => 'warning', 'message' => 'Debe escribir el descuento de la venta.', 'position' => 'center']]);
            return redirect()->to('/administracion/ventas');
            $this->dispatchBrowserEvent('closeModal');

        } elseif ($this->descuento == null && $this->productos == null) {

            session(['alert' => ['type' => 'warning', 'message' => 'Debe selecionar el producto y escribir el descuento de la venta.', 'position' => 'center']]);
            return redirect()->to('/administracion/ventas');
            $this->dispatchBrowserEvent('closeModal');
        }

        $newTotal = $venta[0]->total - $this->descuento;
        if ($this->descuento > $venta[0]->total) {

            session(['alert' => ['type' => 'warning', 'message' => 'El Descuento no puede ser mayor que el total de la Venta.', 'position' => 'center']]);
            return redirect()->to('/administracion/ventas');
            $this->dispatchBrowserEvent('closeModal');

        } else {
            Venta::where('id', '=', $id)->update(['total' => $newTotal, 'estado' => 4]);

            foreach ($this->productos as $key => $p) {
                DetalleVenta::where('id_venta', '=', $id)->where('id_producto', '=', $p)->delete();
                if ($key === array_key_last($this->productos)) {
                    session(['alert' => ['type' => 'success', 'message' => 'Productos Eliminados de la Venta con Exito.', 'position' => 'center']]);
                    return redirect()->to('/administracion/ventas');
                    $this->dispatchBrowserEvent('closeModal');

                }
            }
        }

    }
    public function render()
    {
        return view('livewire.backend.manual-venta-component');
    }
}
