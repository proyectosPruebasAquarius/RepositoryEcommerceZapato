@extends('backend.blank')


@section('title','Listado de Pedidos a Proveedores')


@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <h2 class="mb-2 page-title">Listado de Pedidos a Proveedores</h2>
        <div class="col-12 d-flex justify-content-end mt-3">
            @livewire('backend.pedidos-component')
            @livewire('backend.pedidos-pdf-component')
            <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#pedidosPDFModal">Descargar en PDF <i
                    class="fe fe-file-text fe-16"></i></button>
        </div>

        <div class="row my-4">
            <!-- Small table -->
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <!-- table -->
                        <table class="table datatables" id="dataTable">
                            <thead class="bg-primary">
                                <tr>


                                    <th class="text-start">COD</th>
                                    <th class="text-start">Producto</th>
                                    <th class="text-start">Precio de compra</th>
                                    <th class="text-start">Proveedor</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Fecha de Entrega</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($pedidos as $p)
                                <tr>

                                    <td class="text-start">{{ $p->codigo_producto }}</td>
                                    <td class="text-start">{{ $p->producto }}</td>
                                    <td class="text-start">{{ $p->precio_compra }}</td>
                                    <td class="text-start">{{ $p->proveedor }}</td>

                                    <td class="text-center">

                                        @switch($p->estado_pedido)
                                        @case(0)
                                        <span class="badge badge-secondary">Pendiente de Pedido</span>
                                        @break
                                        @case(1)
                                        <span class="badge badge-primary">Pedido Realizado</span>
                                        @break
                                        @case(2)
                                        <span class="badge badge-danger">Producto no Fabricado</span>
                                        @break
                                        @case(3)
                                        <span class="badge badge-danger">Proveedor no Activo</span>
                                        @break


                                        @endswitch
                                    </td>

                                    <td class="text-center">
                                        @if ($p->fecha_entrega == null)
                                        Sin fecha de entrega

                                        @else
                                        {{ $p->fecha_entrega }}

                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <button type="button" class="btn" data-toggle="modal" data-target="#pedidosModal"
                                            onclick="Livewire.emit('asignPedido',@js($p) )">
                                            <i class="fe fe-edit fe-16 text-success" data-toggle="tooltip"
                                                data-placement="top" title="Editar"></i>
                                        </button>
                                      
                                    </td>
                                </tr>
                                @endforeach




                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- simple table -->
        </div> <!-- end section -->
    </div> <!-- .col-12 -->
</div> <!-- .row -->
@endsection



@push('scripts')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>


@endpush

@push('datatable-scripts')
<script>
    $(document).ready( function () {
       
                $('#dataTable').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
                },
               
            });
            

    



} );


</script>

@endpush

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
@endpush