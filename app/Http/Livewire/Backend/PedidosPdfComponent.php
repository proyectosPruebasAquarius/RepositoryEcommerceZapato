<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use App\Models\PedidoProveedor;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class PedidosPdfComponent extends Component
{
    use LivewireAlert;
    public $fecha_inicio,$fecha_fin;

    protected $listeners = ['pedidoPDF'=>'pedidoPDF','resetDates' => 'resetInput'];

    protected $rules = [
        'fecha_inicio' => 'required|date',
        
    ];

    protected $messages = [
        'fecha_inicio.required' => 'La Fecha de Inicio es Obligatoria',
        'fecha_inicio.date' => 'Formato no valido',
        
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetInput()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset(['fecha_inicio','fecha_fin']);
    }



    
    function pedidoPDF()
    {

        $this->validate();


        if ($this->fecha_fin == null) {  



            $pedidos = PedidoProveedor::join('productos','productos.id','=','pedidos_proveedores.id_producto')->join('inventarios','inventarios.id_producto','=','pedidos_proveedores.id_producto')
            ->join('proveedores','proveedores.id','=','productos.id_proveedor')->select('productos.nombre as producto','productos.cod as cod_prod','proveedores.nombre as proveedor',
            'proveedores.direccion','proveedores.telefono as tel_proveedor','pedidos_proveedores.cantidad','pedidos_proveedores.estado as estado_pedido','pedidos_proveedores.precio as precio_unitario',
            DB::raw('FORMAT(pedidos_proveedores.cantidad * pedidos_proveedores.precio,2) total_unitario'))
            ->groupBy('productos.nombre')->whereDate('pedidos_proveedores.created_at',$this->fecha_inicio)->get();
          
            $total_previsto = PedidoProveedor::whereDate('created_at',$this->fecha_inicio)->select(DB::raw('FORMAT(SUM(pedidos_proveedores.cantidad * pedidos_proveedores.precio),2) total_previsto'))
            ->get();

            if (sizeof($pedidos) == 0) {
                $this->dispatchBrowserEvent('closeModal');
                $this->alert('warning', 'No hay registros con la Fecha: ' . $this->fecha_inicio, [
                    'position' => 'center',
                    'confirmButtonColor' => '#1b68ff',
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Aceptar',
                    'timer' => 20000,
                ]);                
            } else {     
                $this->dispatchBrowserEvent('closeModal');                              
                $pdf = PDF::loadView('pdf.pedido-proveedor',['pedidos' => $pedidos,'fecha_inicio' =>$this->fecha_inicio,'fecha_fin' =>$this->fecha_fin,'total_previsto' => $total_previsto])->setPaper('letter', 'landscape')->output();
                return response()->streamDownload(
                    fn()=> print($pdf),
                    'Pedido Proveedor '.$this->fecha_inicio.'.pdf'
                );

                
            }
            



        } else {
            
                $pedidos = PedidoProveedor::join('productos','productos.id','=','pedidos_proveedores.id_producto')->join('inventarios','inventarios.id_producto','=','pedidos_proveedores.id_producto')
                ->join('proveedores','proveedores.id','=','productos.id_proveedor')->select('productos.nombre as producto','productos.cod as cod_prod','proveedores.nombre as proveedor',
                'proveedores.direccion','proveedores.telefono as tel_proveedor','pedidos_proveedores.cantidad','pedidos_proveedores.estado as estado_pedido',
                DB::raw('FORMAT(SUM(pedidos_proveedores.cantidad * pedidos_proveedores.precio),2) total_previsto'),
                DB::raw('FORMAT(pedidos_proveedores.cantidad * pedidos_proveedores.precio,2) total_unitario'))
                ->groupBy('productos.nombre')->whereBetween('pedidos_proveedores.created_at',[$this->fecha_inicio,$this->fecha_fin])->get();                                               
                $total_previsto = PedidoProveedor::whereBetween('pedidos_proveedores.created_at',[$this->fecha_inicio,$this->fecha_fin])->select(DB::raw('FORMAT(SUM(pedidos_proveedores.cantidad * pedidos_proveedores.precio),2) total_previsto'))
                ->get();
                

            if (sizeof($pedidos) == 0 ) {

                $this->dispatchBrowserEvent('closeModal');
                $this->alert('warning', 'No hay registro en las Fechas selecionadas '.$this->fecha_inicio.' hasta '.$this->fecha_fin, [
                    'position' => 'center',
                    'confirmButtonColor' => '#1b68ff',
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Aceptar',
                    'timer' => 20000,
                ]); 

              
            } else {        
                $this->dispatchBrowserEvent('closeModal');        
                $pdf = PDF::loadView('pdf.pedido-proveedor',['pedidos' => $pedidos,'fecha_inicio' =>$this->fecha_inicio,'fecha_fin' =>$this->fecha_fin,'total_previsto' => $total_previsto])->setPaper('letter', 'landscape')->output();

                return response()->streamDownload(
                    fn()=> print($pdf),
                    'Pedido Proveedor '.$this->fecha_inico.' hasta '.$this->fecha_fin.'.pdf'
                );
                
            }                                  
        }
    }




    public function render()
    {
        return view('livewire.backend.pedidos-pdf-component');
    }
}
