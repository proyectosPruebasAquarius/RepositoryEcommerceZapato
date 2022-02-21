<?php

namespace App\Http\Livewire\Backend;

use App\Models\Venta;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class VentaPdfComponent extends Component
{
    use LivewireAlert;
    public $fecha;
    protected $listeners = ['fechaPDF' => 'fechaPDF', 'resetPDF' => 'resetInput'];
    protected $rules = [
        'fecha' => 'required|date',
    ];

    protected $messages = [
        'fecha.required' => 'La fecha es Obligatoria',
        'fecha.date' => 'Formato no valido',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetInput()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset(['fecha']);
    }

    public function fechaPDF()
    {
        $this->validate();

        $detail = Venta::join('detalle_ventas','detalle_ventas.id_venta','=','ventas.id')->join('productos','productos.id','=','detalle_ventas.id_producto')
        ->join('inventarios','inventarios.id_producto','=','productos.id')->where('ventas.estado','=',1)->whereDate('ventas.created_at',$this->fecha)
        ->select('productos.nombre as producto','detalle_ventas.precio_venta','productos.cod as codigo',DB::raw('SUM(detalle_ventas.cantidad) AS cantidadTotal'))
        ->groupBy('productos.nombre')->orderBy('cantidadTotal','DESC')->get();



        $sumTotal = Venta::select(DB::raw('FORMAT(SUM(ventas.total),2) AS cuentaTotal'))->whereDate('ventas.created_at', $this->fecha)->where('ventas.estado', '=', 1)->get();

        if ($sumTotal[0]->cuentaTotal == null) {
            $this->dispatchBrowserEvent('closeModal');
            $this->alert('warning', 'No hay Ventas registradas con la Fecha: ' . $this->fecha, [
                'position' => 'center',
                'confirmButtonColor' => '#1b68ff',
                'showConfirmButton' => true,
                'confirmButtonText' => 'Aceptar',
                'timer' => 20000,
            ]);
        } else {
            $this->dispatchBrowserEvent('closeModal');
            $pdf = PDF::loadView('pdf.venta-detail', ['sumTotal' => $sumTotal, 'detail' => $detail, 'fecha' => $this->fecha])->output();
            
            return response()->streamDownload(
                fn()=> print($pdf),
                'Detalle de Venta-'.$this->fecha.'.pdf'
            );

            
            
        }

    }

    public function render()
    {
        return view('livewire.backend.venta-pdf-component');
    }
}
