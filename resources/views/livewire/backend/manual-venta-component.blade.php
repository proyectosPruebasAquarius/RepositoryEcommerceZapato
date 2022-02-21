<div>
    <div class="modal fade" id="manualModal" tabindex="-1" aria-labelledby="manualModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title col-11 text-center" id="manualModalLabel">Aprobación Manual</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @inject('Venta', 'App\Models\Venta')
                        @inject('DetalleVenta', 'App\Models\DetalleVenta')
                        @php
                        
                        if (isset($id_venta)) {
                            $detalle_venta = $Venta::join('detalle_ventas','detalle_ventas.id_venta','=','ventas.id')
                            ->join('users','users.id','=','ventas.id_usuario')
                            ->join('direcciones','direcciones.id','=','ventas.id_direccion')
                            ->join('municipios','municipios.id','=','direcciones.id_municipio')
                            ->join('departamentos','departamentos.id','=','municipios.id_departamento')
                            ->join('direcciones_facturaciones','direcciones_facturaciones.id','=','ventas.id_facturacion')
                            ->join('metodos_pagos','metodos_pagos.id','=','ventas.id_metodo_pago')
                            ->join('datos_ventas','datos_ventas.id_venta','=','ventas.id')
                            ->join('productos','productos.id','=','detalle_ventas.id_producto')
                            ->select('direcciones.direccion', 'users.telefono','direcciones_facturaciones.direccion as facturacion','direcciones_facturaciones.referencia as referencia_facturacion',
                            'ventas.total as totalVenta','ventas.estado as estadoVenta','datos_ventas.numero as numeroTransaccion',
                            'datos_ventas.imagen as imagenDatoVenta','ventas.id as id_venta','users.id as id_usuario',
                            'users.name as cliente','users.email as correo','municipios.nombre as municipio','departamentos.nombre as departamento',
                            'direcciones.referencia','metodos_pagos.nombre as metodo_pago','ventas.num_transaccion as numeroTransaccionVenta')
                            ->where('ventas.id','=',$id_venta)->distinct()->get();

                            $productosVenta = $DetalleVenta::join('productos','productos.id','=','detalle_ventas.id_producto')->join('inventarios','inventarios.id_producto','=','productos.id')
                            ->select('productos.nombre','productos.id as id_prod','inventarios.stock','detalle_ventas.cantidad')->where('detalle_ventas.id_venta','=',$id_venta)->get();
                        }

                        @endphp
                        @foreach ($detalle_venta as $ventas )

                        <div class="row">
                            <div class="col-md-4 order-md-2 mb-4">
                                <h3 class="mb-3 text-center"> Productos de la Compra </h3>
                                <table class="table">
                                    <thead class="bg-primary text-center text-white">
                                        <tr>

                                            <th scope="col">Producto</th>
                                            <th scope="col">Stock Disponible</th>
                                            <th scope="col">Cantidad de la compra</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($productosVenta as $p)
                                        <tr>
                                            <td>
                                                {{ $p->nombre }}
                                            </td>
                                            <td>
                                                {{ $p->stock }}
                                            </td>
                                            <td>
                                                {{ $p->cantidad }}
                                            </td>

                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <form wire:submit.prevent="manualupd">

                                    <div class="list-group">
                                        @error('productos') <span class="text-danger">{{ $message }}</span> @enderror
                                        @foreach ($productosVenta as $p)
                                        <label class="list-group-item">
                                            <input class="form-check-input " type="checkbox" value="{{ $p->id_prod }}"
                                                wire:model='productos'>
                                            {{ $p->nombre }}
                                        </label>
                                        @endforeach
                                        <label class="list-group-item">
                                            <input class="form-control me-1    @error('descuento') is-invalid @enderror"
                                                type="text" wire:model="descuento" placeholder="Cantida a descontar">

                                            @error('descuento') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <button onclick="Livewire.emit('manualupd',@js($ventas->id_venta) )"
                                                class="btn btn-danger me-1 mb-1 mt-3" form="formMail">
                                                <i class="fe fe-trending-down fe-16"></i>
                                                Descontar
                                                Producto</button>
                                        </label>
                                    </div>
                                </form>


                            </div>
                            <div class="col-md-8 order-md-1">
                                <h4 class="mb-3">Detalles del Ciente</h4>
                                <form class="needs-validation" novalidate>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="firstName">Nombre</label>
                                            <input type="text" class="form-control" disabled
                                                value="{{ $ventas->cliente }}">

                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label for="firstName">Telefono </label>
                                            <input type="text" class="form-control" disabled
                                                value="{{ $ventas->telefono }}">

                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="firstName">Correo </label>
                                            <input type="text" class="form-control" disabled
                                                value="{{ $ventas->correo }}">

                                        </div>

                                    </div>

                                    <div class="mb-3">
                                        <label for="username">Dirección </label>
                                        <div class="input-group">
                                            <textarea class="form-control" disabled
                                                id="validationTextarea">{{ ($ventas->direccion != null )? $ventas->direccion : 'Sin Direccion'  }} </textarea>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email">Referencias de Dirección</label>
                                        <textarea class="form-control" disabled
                                            id="validationTextarea">{{ ($ventas->referencia != null )? $ventas->referencia : 'Sin Referencias de dirección'  }} </textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="username">Dirección de Facturación</label>
                                        <div class="input-group">
                                            <textarea class="form-control" disabled
                                                id="validationTextarea">{{ ($ventas->facturacion != null )? $ventas->facturacion : 'Sin Direccion de Facturacion'  }} </textarea>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email">Referencias de Facturación</label>
                                        <textarea class="form-control" disabled
                                            id="validationTextarea">{{ ($ventas->referencia_facturacion != null )? $ventas->referencia_facturacion : 'Sin Referencias de facturacion'  }} </textarea>
                                    </div>



                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="country">Departamento</label>
                                            <input type="text" class="form-control" disabled
                                                value="{{ $ventas->departamento }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="state">Municipio</label>
                                            <input type="text" class="form-control" disabled
                                                value="{{ $ventas->municipio }}">
                                        </div>

                                    </div>

                                    <hr class="mb-4">

                                    <h4 class="mb-3">Datos de Pago</h4>


                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="cc-name">Método de Pago</label>
                                            <input type="text" class="form-control" id="cc-name"
                                                value="{{ $ventas->metodo_pago }}" disabled>

                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cc-number">Numero de Transacción del Cliente</label>
                                            <input type="text" class="form-control" id="cc-number"
                                                value="{{ $ventas->numeroTransaccion }}" disabled>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="cc-expiration">Estado de la Venta</label>
                                            <input type="text" class="form-control" id="cc-expiration" disabled
                                                value="@if($ventas->estadoVenta == 0)Pendiente de revisión @elseif($ventas->estadoVenta == 1)Aprobada @elseif ($ventas->estadoVenta == 2)Aprobación Manual @else Rechazada @endif">

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12 text-center">
                                            <br>
                                            <h3>Imagen de revición del Cliente </h3>
                                            <br>

                                            <img src="{{ asset('storage/photo/') }}/{{ $ventas->imagenDatoVenta }}"
                                                alt="">

                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                        @endforeach
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                </div>
            </div>
        </div>
    </div>
</div>