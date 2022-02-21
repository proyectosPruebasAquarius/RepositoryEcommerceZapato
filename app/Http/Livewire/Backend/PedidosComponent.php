<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use App\Models\PedidoProveedor;

class PedidosComponent extends Component
{

    public $id_pedido,$codigo_producto,$producto,$precio_compra,$proveedor,$direc_proveedor,$tel_proveedor,$contacto,$tel_contacto,$estado_proveedor,$fecha_entrega,$estado_pedido,$cantidad;

    protected $listeners = ['asignPedido' => 'asignPedido','UpdPedido'=>'UpdPedido','resetNamesPedido'=> 'resetInput'];


    protected   $rules = [           
        'precio_compra' => ['required','regex:/^(?:[1-9]\d+|\d)(?:\.\d\d)?$/'],
        'cantidad' => ['required','numeric'],        
    ];

    protected $messages = [
        'precio_compra.required' => 'El Precio de Compra es Obligatorio.',
        'precio_compra.regex' => 'El formato del Precio de Compra es inválido.',                        
        'cantidad.required' => 'La Cantidad del Producto del Pedido es Obligatorio',
        'cantidad.numeric' => 'Formato de número no valido'
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }






    public function asignPedido($pedido)
    {
        $this->id_pedido = $pedido['id_pedido'];
        $this->codigo_producto = $pedido['codigo_producto'];
        $this->producto = $pedido['producto'];
        $this->precio_compra = $pedido['precio_compra'];
        $this->proveedor = $pedido['proveedor'];
        $this->direc_proveedor = $pedido['direc_proveedor'];
        $this->tel_proveedor = $pedido['tel_proveedor'];
        $this->contacto = $pedido['contacto'];
        $this->tel_contacto = $pedido['tel_contacto'];
        $this->estado_proveedor = $pedido['estado_proveedor'];
        $this->fecha_entrega = $pedido['fecha_entrega'];
        $this->estado_pedido = $pedido['estado_pedido'];
        $this->cantidad = $pedido['cantidad'];

    }


    public function resetInput()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset(['id_pedido','codigo_producto','producto','precio_compra','proveedor','direc_proveedor','tel_proveedor','contacto','tel_contacto','estado_proveedor','fecha_entrega','estado_pedido','cantidad']);
    }




    public function UpdPedido()
    {
        $this->validate();
        try {
            PedidoProveedor::where('id','=',$this->id_pedido)->update([
                'precio' => $this->precio_compra,
                'cantidad' => $this->cantidad,
                'estado' => $this->estado_pedido,
                'fecha_entrega' => $this->fecha_entrega
            ]);
            session(['alert' => ['type' => 'success', 'message' => 'Pedido Actualizado con Exito.', 'position' => 'center']]);
            return redirect()->to('/administracion/pedidos');
            $this->dispatchBrowserEvent('closeModal');
        } catch (\Throwable $th) {
            session(['alert' => ['type' => 'warning', 'message' => 'Ocurrio un error, intenta nuevamente.', 'position' => 'center']]);
            return redirect()->to('/administracion/pedidos');
            $this->dispatchBrowserEvent('closeModal');
        }
       

    }





    public function render()
    {
        return view('livewire.backend.pedidos-component');
    }
}
