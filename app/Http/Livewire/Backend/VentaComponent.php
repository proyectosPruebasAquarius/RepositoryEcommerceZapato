<?php

namespace App\Http\Livewire\Backend;

use App\Models\DetalleVenta;
use App\Models\Inventario;
use App\Models\PedidoProveedor;
use App\Models\Venta;
use App\Models\User;
use App\Notifications\MinStock;
use DB;
use App\Mail\OutStock;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class VentaComponent extends Component
{
    use LivewireAlert;
    public $id_venta, $detalle_venta = [], $estado, $productosVenta = [];
    protected $listeners = ['detalleVenta' => 'detalleVenta', 'ventaApproved' => 'ventaApproved', 'ventaRejected' => 'ventaRejected', 'detalleVentaNoti' => 'detalleVentaNoti','confirmed'];

    public function detalleVenta($id)
    {
        $this->dispatchBrowserEvent('reloadT');
        $this->detalle_venta = Venta::join('detalle_ventas', 'detalle_ventas.id_venta', '=', 'ventas.id')->join('users', 'users.id', '=', 'ventas.id_usuario')->join('direcciones', 'direcciones.id', 'ventas.id_direccion')
            ->join('municipios', 'municipios.id', '=', 'direcciones.id_municipio')->join('departamentos', 'departamentos.id', '=', 'municipios.id_departamento')
            ->join('direcciones_facturaciones', 'direcciones_facturaciones.id', 'ventas.id_facturacion')
            ->join('metodos_pagos', 'metodos_pagos.id', '=', 'ventas.id_metodo_pago')
            ->join('datos_ventas', 'datos_ventas.id_venta', '=', 'ventas.id')
            ->join('productos', 'productos.id', '=', 'detalle_ventas.id_producto')
            ->select('direcciones.direccion', 'users.telefono', 'direcciones_facturaciones.direccion as facturacion', 'direcciones_facturaciones.referencia as referencia_facturacion', 'ventas.total as totalVenta', 'ventas.estado as estadoVenta', 'datos_ventas.numero as numeroTransaccion',
                'datos_ventas.imagen as imagenDatoVenta', 'ventas.id as id_venta', 'users.id as id_usuario', 'users.name as cliente', 'users.email as correo', 'municipios.nombre as municipio', 'departamentos.nombre as departamento',
                'direcciones.referencia', 'metodos_pagos.nombre as metodo_pago', 'ventas.num_transaccion as numeroTransaccionVenta')->where('ventas.id', '=', $id)->distinct()->get();

        $this->productosVenta = DetalleVenta::join('productos', 'productos.id', '=', 'detalle_ventas.id_producto')->select('productos.nombre', 'detalle_ventas.precio_venta', 'detalle_ventas.oferta', 'productos.imagen', 'detalle_ventas.cantidad')
            ->where('detalle_ventas.id_venta', '=', $id)->get();

    }

    public function detalleVentaNoti($id, $notify)
    {
        $this->dispatchBrowserEvent('closeModal');
        if ($notify !== null) {
            DB::table('notifications')->where('id', '=', $notify)->update(['read_at' => now()]);

        }

        $this->dispatchBrowserEvent('reloadT');
        $this->detalle_venta = Venta::join('detalle_ventas', 'detalle_ventas.id_venta', '=', 'ventas.id')->join('users', 'users.id', '=', 'ventas.id_usuario')->join('direcciones', 'direcciones.id', 'ventas.id_direccion')
            ->join('municipios', 'municipios.id', '=', 'direcciones.id_municipio')->join('departamentos', 'departamentos.id', '=', 'municipios.id_departamento')
            ->join('direcciones_facturaciones', 'direcciones_facturaciones.id', 'ventas.id_facturacion')
            ->join('metodos_pagos', 'metodos_pagos.id', '=', 'ventas.id_metodo_pago')
            ->join('datos_ventas', 'datos_ventas.id_venta', '=', 'ventas.id')
            ->join('productos', 'productos.id', '=', 'detalle_ventas.id_producto')
            ->select('direcciones.direccion', 'users.telefono', 'direcciones_facturaciones.direccion as facturacion', 'direcciones_facturaciones.referencia as referencia_facturacion', 'ventas.total as totalVenta', 'ventas.estado as estadoVenta', 'datos_ventas.numero as numeroTransaccion',
                'datos_ventas.imagen as imagenDatoVenta', 'ventas.id as id_venta', 'users.id as id_usuario', 'users.name as cliente', 'users.email as correo', 'municipios.nombre as municipio', 'departamentos.nombre as departamento',
                'direcciones.referencia', 'metodos_pagos.nombre as metodo_pago', 'ventas.num_transaccion as numeroTransaccionVenta')->where('ventas.id', '=', $id)->distinct()->get();

        $this->productosVenta = DetalleVenta::join('productos', 'productos.id', '=', 'detalle_ventas.id_producto')->select('productos.nombre', 'detalle_ventas.precio_venta', 'detalle_ventas.oferta', 'productos.imagen', 'detalle_ventas.cantidad')
            ->where('detalle_ventas.id_venta', '=', $id)->get();

    }

    public function ventaApproved($id)
    {
        $productosVenta = DetalleVenta::join('productos', 'productos.id', '=', 'detalle_ventas.id_producto')->select('detalle_ventas.id_producto', 'detalle_ventas.cantidad')->where('detalle_ventas.id_venta', '=', $id)->get();
        \Config::set('firts', 0); //$firts = 0;
        foreach ($productosVenta as $key => $p) {

            $inventarioStock = Inventario::select('id as id_inventario', 'stock', 'min_stock', 'precio_compra')->where('id_producto', '=', $p->id_producto)->first();

            $id_notify = $inventarioStock->id_inventario;
            if ($inventarioStock->stock == $inventarioStock->min_stock || $inventarioStock->stock < $inventarioStock->min_stock) {
                $admins = User::where('id_tipo_usuario', 1)->get();

                $isSaved = PedidoProveedor::where('id_producto',$p->id_producto)->first();

                if ($isSaved != null) {
                    \Notification::send($admins, new MinStock($id_notify));
                } else {
                    \Notification::send($admins, new MinStock($id_notify));

                    $pedido_proveedor = new PedidoProveedor;
                    $pedido_proveedor->id_producto = $p->id_producto;
                    $pedido_proveedor->precio = $inventarioStock->precio_compra;
                    $pedido_proveedor->created_at = date("Y-m-d");
                    $pedido_proveedor->save();
                }
                

               
            }
            if ($p->cantidad > $inventarioStock->stock) {
                \Config::set('firts', 1);

            }

            if ($key === array_key_last($productosVenta->toArray())) {
                if (\Config::get('firts') > 0) {
                    \Config::set('firts', 0);
                    Venta::where('id', '=', $id)->update(['estado' => 2]);


                    $email = DetalleVenta::join('productos', 'productos.id', '=', 'detalle_ventas.id_producto')->join('inventarios', 'inventarios.id_producto', '=', 'productos.id')
                    ->join('ventas', 'ventas.id', '=', 'detalle_ventas.id_venta')->join('users', 'users.id', '=', 'ventas.id_usuario')
                    ->select('productos.nombre', 'productos.id as id_prod', 'inventarios.stock', 'detalle_ventas.cantidad', 'users.email as correo', 'ventas.created_at as fecha')->where('detalle_ventas.id_venta', '=', $id)->get();                    
                    \Mail::to($email[0]->correo)->send(new OutStock($email));
              
                    $this->dispatchBrowserEvent('closeModal');
                    $this->alert('warning', 'El stock actual del producto es menos que la cantidad seleccionada del producto', [
                        'position' => 'center',

                        'confirmButtonColor' => '#1b68ff',
                        'showConfirmButton' => true,
                        'confirmButtonText' => 'Aceptar',
                        'text' => 'Se queriere una revición manual de la venta',
                        'footer' => 'El cliente a sido notificado por esta acccion, ponte en contacto con el cliente.',
                        'timer' => 20000,
                        'onConfirmed' => 'confirmed' ,
                    ]);

                } else {
                    $newStock = $inventarioStock->stock - $p->cantidad;
                    Inventario::where('id', '=', $inventarioStock->id_inventario)->update(['stock' => $newStock]);
                    Venta::where('id', '=', $id)->update(['estado' => 1]);
                    session(['alert' => ['type' => 'success', 'message' => 'Venta Aprobada con Exito.', 'position' => 'center']]);
                    return redirect()->to('/administracion/ventas');
                    $this->dispatchBrowserEvent('closeModal');
                }
            }
        }

    }

    public function confirmed()
    {
        return redirect()->to('/administracion/ventas');
    }

    public function ventaRejected($id)
    {
        Venta::where('id', '=', $id)->update(['estado' => 3]);
        session(['alert' => ['type' => 'success', 'message' => 'Venta Rechzada con Exito.', 'position' => 'center']]);
        return redirect()->to('/administracion/ventas');
        $this->dispatchBrowserEvent('closeModal');

    }

    public function render()
    {
        return view('livewire.backend.venta-component');
    }
}
