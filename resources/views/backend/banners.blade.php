@extends('backend.blank')


@section('title','Listado de Banners')


@section('content')
<div class="row justify-content-center">
    <div class="col-12">
      <h2 class="mb-2 page-title">Listado de Banners</h2>
      <div class="col-12 d-flex justify-content-end mt-3">
          @livewire('backend.banner-component')
        <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#bannerModal">Agregar <i class="fe fe-plus fe-16"></i></button>
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
                   
                   
                    <th class="text-start">Titulo</th>
                    <th  class="text-start">Sub titulo</th>
                    <th  class="text-start">Descripción</th>
                    <th  class="text-center">Imagen</th>                                       
                    <th  class="text-center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  
                  
                
                  @foreach ($banners as $b)
                  <tr>
                    
                    <td  class="text-start">{{ $b->titulo }}</td>
                    <td  class="text-start">{{ $b->sub_titulo }}</td>
                    <td  class="text-start">{{ $b->descripcion }}</td>
                    <td class="text-center">
                        <img src="{{ asset($b->imagen) }}" alt="..." class="img-thumbnail w-50 h-50">
                    </td>
                    
                    <td  class="text-center">
                      <button type="button" class="btn" 
                      data-toggle="modal" data-target="#bannerModal" onclick="Livewire.emit('asignBanner',@js($b) )">
                        <i class="fe fe-edit fe-16 text-success"  data-toggle="tooltip" data-placement="top" title="Editar"></i>
                      </button>
                      <button type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Eliminar"  onclick="trash(@js($b->id_banner))">
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
            title: '¿Estás seguro que desea Eliminar este Banner?',
            text: "¡Está acción es irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('dropByStateBanner', id)
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