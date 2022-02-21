<div>
  <a class="nav-link text-muted my-2" type="button" data-toggle="modal" data-target=".modal-notif">
    <span class="fe fe-bell fe-16" data-toggle="tooltip" data-placement="left" title="Notificaciones"></span>
    @if (sizeof($noty) <> 0)
      <span class="dot dot-md bg-success"></span>
      @else

      @endif
  </a>
  <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel"
    aria-hidden="true" wire:ignore.self id="modal-notif">
    <div class="modal-dialog modal-sm modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="defaultModalLabel">Notificaciones</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="list-group list-group-flush my-n3">

            <div class="list-group-item bg-transparent">

              @forelse ($noty as $n)

              @if (isset($n->data['id_inventario']))
              @php
              $product =
              DB::table('inventarios')->join('productos','inventarios.id_producto','=','productos.id')->select('productos.nombre')->where('inventarios.id','=',$n->data['id_inventario'])->get();
              @endphp

              <div class="row align-items-center">
                <div class="col-auto">
                  <span class="fe fe-package fe-24"></span>
                </div>
                <div class="col">
                  <a type="button" hrer="{{ url('administracion/pedidos') }}">
                    <small><strong>Stock minimo de : {{ $product[0]->nombre }} Alcanzado</strong></small>
                    <div class="my-0 text-muted small">Revision disponible</div>
                    
                  </a>

                </div>
              </div>


              @else
              <div class="row align-items-center">
                <div class="col-auto">
                  <span class="fe fe-dollar-sign fe-24"></span>
                </div>
                <div class="col">
                  <a type="button" data-toggle="modal" data-target="#detalleVentaModal"
                    onclick="Livewire.emit('detalleVentaNoti',@js($n->data['venta_id']),@js($n->id) )">
                    <small><strong>Nueva Venta realizada</strong></small>
                    <div class="my-0 text-muted small">Revision de venta disponible</div>
                    <small class="badge badge-pill badge-light text-muted">{{  date('Y-m-d H:i:s', strtotime($n->data['fecha'] ))}}</small>
                  </a>

                </div>
              </div>
              @endif



              @empty

              <div class="row align-items-center">
                <div class="col-auto">
                  <span class="fe fe-slash fe-24"></span>
                </div>
                <div class="col">
                  <small><strong>No hay notificaciones disponibles</strong></small>

                </div>
              </div>

              @endforelse

            </div>

          </div> <!-- / .list-group -->
        </div>
        <!--  <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Clear All</button>
            </div>--->
      </div>
    </div>
  </div>

  @push('scripts')
  <script>
    /* $('#tallaModal').on('hidden.bs.modal', function (e) {
        Livewire.emit('resetNamesTal');
    })*/

    window.addEventListener('closeModal', event => {
    $("#modal-notif").modal('hide');  
      
      
    });

 

  </script>
  @endpush