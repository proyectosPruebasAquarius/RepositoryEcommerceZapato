@extends('backend.blank')


@section('title','Listado de Metodos de Pago')


@section('content')
<div class="row justify-content-center">
    <div class="col-12">
      <h2 class="mb-2 page-title">Listado de Metodos de Pago</h2>
      <div class="col-12 d-flex justify-content-end mt-3">
          @livewire('backend.metodo-pago-component')
        <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#metodoModal">Agregar <i class="fe fe-plus fe-16"></i></button>
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
                    <th class="text-start">QR</th>
                    <th class="text-start">Nùmero de cuenta</th>
                    <th class="text-start">Nombre asociado</th>
                    <th  class="text-center">Estado</th>
                   
                    <th  class="text-center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  
                  
                
                  @foreach ($metodos as $m)
                  <tr>
                    
                    <td  class="text-start">{{ $m->nombre }}</td>

                    <td  class="text-start">
                      @foreach (json_decode($m->qr) as $img)
                      <img src="{{ asset('/storage/images/metodos_pagos/'.$img)}}" alt="" class="img-responsive w-25">
                      @endforeach
                       
                    </td>

                    <td  class="text-start">
                        {{ $m->numero }}
                    </td>
                    <td  class="text-start">
                        {{ $m->cuenta_asociado }}
                    </td>

                    <td  class="text-center">
                      @if ($m->estado == 0)
                      <span class="badge badge-danger ">Desactivada</span>
                          
                      @else
                      <span class="badge badge-primary">Activa</span>
                          
                      @endif
                    </td>
                    
                    <td  class="text-center">
                      <button type="button" class="btn" 
                      data-toggle="modal" data-target="#metodoModal" onclick="Livewire.emit('asignMetodo',@js($m) )">
                        <i class="fe fe-edit fe-16 text-success"  data-toggle="tooltip" data-placement="top" title="Editar"></i>
                      </button>
                      <button type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Eliminar"  onclick="trash(@js($m->id_marca))">
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
            title: '¿Estás seguro que desea desactivar este Metodo de Pago?',
           // text: "¡Está acción es irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, desactivar',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('dropByStateMetodo', id)
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