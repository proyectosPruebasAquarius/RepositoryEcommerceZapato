@extends('backend.blank')


@section('title','Listado de Ventas')


@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <h2 class="mb-2 page-title">Listado de Ventas</h2>
        <div class="col-12 d-flex justify-content-end mt-3">
            @livewire('backend.venta-component')
            @livewire('backend.manual-venta-component')
            @livewire('backend.venta-pdf-component')
            <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#ventaPDFModal ">Detalle de Venta <i class="fe fe-file fe-16"></i></button>
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


                                    <th class="text-start">Cliente</th>
                                    <th class="text-start">Direccion</th>
                                    <th class="text-start">Metodo de Pago</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Fecha de Registro</th>
                                    <th class="text-center">Estado</th>

                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>



                                @foreach ($ventas as $venta)
                                <tr>
                                    <td class="text-start">{{ $venta->cliente }}</td>

                                    <td class="text-start">{{ $venta->direccion }}</td>
                                    <td class="text-start">{{ $venta->metodo_pago }}</td>
                                    <th class="text-center">${{ $venta->total }}</th>
                                    <th class="text-center">{{ $venta->fecha }}</th>


                                    @switch($venta->estado)
                                    @case(0)
                                    <td class="text-center">
                                        <span class="badge badge-primary">Pendiente</span>

                                    </td>
                                    @break
                                    @case(1)
                                    <td class="text-center">
                                        <span class="badge badge-success text-white">Aprobada</span>
                                    </td>
                                    @break
                                    @case(2)
                                    <td class="text-center">
                                        <span class="badge badge-warning">Aprovación Manual</span>
                                    </td>
                                    @break
                                    @case(3)
                                    <td class="text-center">
                                        <span class="badge badge-danger">Rechazada</span>
                                    </td>
                                    @break
                                    @case(4)
                                    <td class="text-center">
                                        <span class="badge badge-secondary">Venta Editada (Pendiente de
                                            Aprobación)</span>
                                    </td>
                                    @break

                                    @endswitch
                                    <td class="text-center">
                                        <button type="button" class="btn" data-toggle="modal"
                                            data-target="#detalleVentaModal"
                                            onclick="Livewire.emit('detalleVenta',@js($venta->id_venta) )">
                                            <i class="fe fe-external-link fe-16 text-primary" data-toggle="tooltip"
                                                data-placement="top" title="Detalle de la Venta"></i>
                                        </button>
                                        @if ($venta->estado == 2)
                                        <button type="button" class="btn" data-toggle="modal"
                                            data-target="#manualModal"
                                            onclick="Livewire.emit('detalleVentaManual',@js($venta->id_venta) )">
                                            <i class="fe fe-search fe-16 text-warning" data-toggle="tooltip"
                                                data-placement="top" title="Aprobación Manual"></i>
                                        </button>
                                        @endif

                                    </td>
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
<script>
    window.addEventListener('reloadT', () => {

        $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
});
</script>




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