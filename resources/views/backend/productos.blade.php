@extends('backend.blank')


@section('title','Listado de Productos')


@section('content')
<div class="row justify-content-center">
  <div class="col-12">
    <h2 class="mb-2 page-title">Listado de Productos</h2>
    <div class="col-12 d-flex justify-content-end mt-3">
      @livewire('backend.producto-component')
      @livewire('backend.update-color-talla-component')
      @livewire('backend.update-talla-component')
      @livewire('backend.update-categoria-sub-component')

      <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#productoModal">Agregar <i
          class="fe fe-plus fe-16"></i></button>
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
                  <th class="text-start">Nombre</th>
                  <th class="text-center">Descripción</th>
                  <th class="text-center">Imagenes</th>
                  <th class="text-start">Categoria y Sub Categoria</th>
                  <th class="text-center">Tallas</th>
                  <th class="text-center">Colores</th>
                  <th class="text-start">Proveedor</th>
                  <th class="text-start">Marca</th>
                  <th class="text-start">Estilo</th>


                  <th class="text-center">Estado</th>

                  <th class="text-center">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($productos as $pro => $product)
                @php
                  $tallas = DB::table('detalles_tallas')->join('tallas','tallas.id','=','detalles_tallas.id_talla')
                  ->join('productos','productos.id','=','detalles_tallas.id_producto')
                  ->where('detalles_tallas.id_producto',$product->id_producto)->select('tallas.nombre','tallas.id as id_talla','detalles_tallas.id as detalle_talla')->get();
                  $colores = DB::table('detalles_colores')->join('colores','colores.id','=','detalles_colores.id_color')
                  ->join('productos','productos.id','=','detalles_colores.id_producto')
                  ->where('detalles_colores.id_producto',$product->id_producto)->select('colores.nombre','colores.color','colores.id as updateColor','detalles_colores.id as detalle_color')->get();

                  $catAndSub = DB::table('detalles_productos')->join('productos','productos.id_detalle_producto','=','detalles_productos.id')
                  ->join('categorias','categorias.id','=','detalles_productos.id_categoria')->join('sub_categorias','sub_categorias.id','=','detalles_productos.id_sub_categoria')
                  ->where('productos.id',$product->id_producto)->select('categorias.nombre as nombre_categoria','categorias.id as id_categoria','sub_categorias.nombre as nombre_sub','sub_categorias.id as id_sub','detalles_productos.id as detalle_producto')
                  ->get();


                @endphp
                <tr>
                <td class="text-start">{{ $product->cod }}</td>
                <td class="text-start">{{ $product->nombre }}</td>
                <td class="text-center">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#descModal{{ $pro }}">
                    Descripción
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="descModal{{ $pro }}" tabindex="-1" aria-labelledby="descModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="descModalLabel">Descripción del Producto: {{ $product->nombre }}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>
                            {{ $product->descripcion }}
                          </p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                         
                        </div>
                      </div>
                    </div>
                  </div>
                </td>

                <td class="text-center">                
                  <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#imgModal{{ $pro }}">
                    <i class="fe fe-image fe-16 "></i>
                  </button>                  
                  <div class="modal fade" id="imgModal{{ $pro }}" tabindex="-1" aria-labelledby="imgModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title col-11 text-center" id="imgModalLabel">Imagenes de {{ $product->nombre }}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div id="imgModalControls{{ $pro }}" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                              @foreach (json_decode($product->imagen) as $img)
                              <div class="carousel-item 
                              @if ($loop->first)
                              active
                              @endif
                              
                              
                              ">
                                <img src="{{ asset('storage/'.$img) }}" class="d-block w-100 img-fluid" >
                              </div>
                              @endforeach
                             
                             
                            </div>
                            <a class="carousel-control-prev" href="#imgModalControls{{ $pro }}" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#imgModalControls{{ $pro }}" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                         
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
                <td class="text-start" data-toggle="tooltip" data-placement="top" title="Click para editar">
                  @foreach ($catAndSub as $cas)
                  <button class="btn btn-outline-primary" data-toggle="modal"  data-target="#catModal" onclick="Livewire.emit('asignCat',@js($cas) )">
                    {{ $cas->nombre_categoria }} / {{ $cas->nombre_sub }}
                  </button>
                      
                  @endforeach
                </td>

                <td class="text-center">
                 
                  <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="tallasDropDown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Tallas
                    </button>
                    <div class="dropdown-menu" aria-labelledby="tallasDropDown">
                      <ul class="list-group">
                        @foreach ($tallas as $t)
                        <li class="list-group-item" data-toggle="tooltip" data-placement="top" title="Click para editar">
                          
                          <button class="btn" data-toggle="modal" data-target="#tallaModal" onclick="Livewire.emit('asignTalla',@js($t) )">
                            {{ $t->nombre }}  
                          </button>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>                                 
                </td>

                <td class="text-center">
                 
                  <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="coloresDropDown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Colores
                    </button>
                    <div class="dropdown-menu" aria-labelledby="coloresDropDown">
                      <ul class="list-group">
                        @foreach ($colores as $c)
                        <li class="list-group-item" data-toggle="modal" data-target="#colorModal">{{ $c->nombre }} 
                          &nbsp;
                          <button class="btn" style="background-color: {{ $c->color }}; height:25px;width:25px" data-toggle="tooltip" data-placement="top" title="Click para editar"
                            onclick="Livewire.emit('asignColor',@js($c) )" >

                          </button>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>                                 
                </td>

                
                <td class="text-start">{{ $product->proveedor_nombre }}</td>
                <td class="text-start">{{ $product->marca_nombre }}</td>
                <td class="text-start">{{ $product->estilo_nombre }}</td>

              



                <td class="text-center">
                  @if ($product->estado == 0)
                  <span class="badge badge-danger ">Desactivado</span>

                  @else
                  <span class="badge badge-primary">Activo</span>

                  @endif
                </td>

                <td class="text-center">
                  <button type="button" class="btn" data-toggle="modal" data-target="#productoModal"
                    onclick="Livewire.emit('asignProducto',@js($product) )">
                    <i class="fe fe-edit fe-16 text-success" data-toggle="tooltip" data-placement="top"
                      title="Editar"></i>
                  </button>
                  <button type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Desactivar"
                    onclick="trash(@js($product->id_producto))">
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
            title: '¿Estás seguro que desea desactivar este Producto?',
            //text: "¡Está acción es irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, desactivar',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('dropByStateProducto', id)
            }
        })
    }


    let trashColor = (id) => {
        Swal.fire({
            title: '¿Estás seguro de eliminar este Color?',
            text: "¡Está acción es irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('dropColor', id)
            }
        })
    }

    
    let trashTalla = (id) => {
        Swal.fire({
            title: '¿Estás seguro de eliminar esta Talla?',
            text: "¡Está acción es irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('dropTalla', id)
            }
        })
    }



</script>


<script>
  window.addEventListener('contentChanged', event => {
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