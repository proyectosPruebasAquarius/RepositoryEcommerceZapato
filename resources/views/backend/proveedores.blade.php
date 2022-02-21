@extends('backend.blank')


@section('title','Listado de Proveedores')


@section('content')
<div class="row justify-content-center">
    <div class="col-12">
      <h2 class="mb-2 page-title">Listado de Proveedores</h2>
      <div class="col-12 d-flex justify-content-end mt-3">
          @livewire('backend.proveedor-component')
        <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#proveedorModal">Agregar <i class="fe fe-plus fe-16"></i></button>
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
                   
                   
                    <th class="text-start">Nombre</th>
                    <th class="text-start">Dirección</th>
                    <th class="text-start">Telefono</th>
                    <th class="text-start">Contacto</th>
                    <th class="text-start">Telefono del Contacto</th>
                    <th  class="text-center">Estado</th>
                   
                    <th  class="text-center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  
                  
                
                  @foreach ($proveedores as $pro)
                  <tr>
                    
                    <td  class="text-start">{{ $pro->nombre }} </td>
                    <td  class="text-start">{{ $pro->direccion }} </td>
                    <td  class="text-start">{{ $pro->telefono }} </td>
                    <td  class="text-start">{{ $pro->nombre_contacto }} </td>
                    <td  class="text-start">{{ $pro->tel_contacto }} </td>
                    <td  class="text-center">
                      @if ($pro->estado == 0)
                      <span class="badge badge-danger ">Desactivado</span>
                          
                      @else
                      <span class="badge badge-primary">Activo</span>
                          
                      @endif
                    </td>
                    
                    <td  class="text-center">
                      <button type="button" class="btn" 
                      data-toggle="modal" data-target="#proveedorModal" onclick="Livewire.emit('asignProveedor',@js($pro) )">
                        <i class="fe fe-edit fe-16 text-success"  data-toggle="tooltip" data-placement="top" title="Editar"></i>
                      </button>
                      <button type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Eliminar"  onclick="trash(@js($pro->id_proveedor))">
                        <i class="fe fe-trash fe-16 text-danger"></i>
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
<script>
    let trash = (id) => {
        Swal.fire({
            title: '¿Estás seguro que desea desactivar este Proveedor?',
           // text: "¡Está acción es irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, desactivar',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('dropByStateProveedor', id)
            }
        })
    }
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