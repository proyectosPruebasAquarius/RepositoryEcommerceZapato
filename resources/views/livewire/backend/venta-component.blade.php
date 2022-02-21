<div>
    <div class="modal fade" id="detalleVentaModal" tabindex="-1" aria-labelledby="detalleVentaModalLabel" aria-hidden="true" wire:ignore.self >
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title col-11 text-center" id="detalleVentaModalLabel">Detalle de la Venta</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" >
                <form>
                   @foreach ($detalle_venta as $ventas )
                       
                   <div class="row">
                    <div class="col-md-4 order-md-2 mb-4">
                      <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span >Productos</span>
                        <span class="badge badge-secondary badge-pill">{{ sizeof($productosVenta) }}</span>
                      </h4>
                      <ul class="list-group mb-3">
                          @foreach ($productosVenta as $pt)
                          <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                              <h6 class="my-0">{{ $pt->nombre }}</h6>
                              <small class="text-muted">Brief description</small>
                            </div>
                            <span>{{ $pt->cantidad }}</span>

                            @if ($pt->oferta != null)
                            <span>{{ $pt->oferta }}%</span>
                            @else
                            
                            @endif
                            <span class="text-black">${{ $pt->precio_venta *  $pt->cantidad}}</span>
                          </li> 
                           @endforeach
                          <li class="list-group-item d-flex justify-content-between">
                            <span>Total (USD)</span>
                            <strong>${{ $detalle_venta[0]->totalVenta }}</strong>
                          </li>
                        
                        
                       
                        
                        
                      </ul>
                
                      
                    </div>
                    <div class="col-md-8 order-md-1">
                      <h4 class="mb-3">Detalles del Ciente</h4>
                      <form class="needs-validation" novalidate>
                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label for="firstName">Nombre</label>
                            <input type="text" class="form-control"  disabled value="{{ $ventas->cliente }}" >
                           
                          </div>
                          <div class="col-md-2 mb-3">
                            <label for="firstName">Telefono </label>
                            <input type="text" class="form-control" disabled value="{{ $ventas->telefono }}" >
                           
                          </div>

                          <div class="col-md-4 mb-3">
                            <label for="firstName">Correo </label>
                            <input type="text" class="form-control" disabled value="{{ $ventas->correo }}" >
                           
                          </div>
                          
                        </div>
                
                        <div class="mb-3">
                          <label for="username">Dirección </label>
                          <div class="input-group">
                            <textarea class="form-control" disabled id="validationTextarea">{{ ($ventas->direccion != null )? $ventas->direccion : 'Sin Direccion'  }} </textarea>
                          </div>
                        </div>
                
                        <div class="mb-3">
                          <label for="email">Referencias de Dirección</label>
                          <textarea class="form-control" disabled id="validationTextarea">{{ ($ventas->referencia != null )? $ventas->referencia : 'Sin Referencias de dirección'  }} </textarea>
                        </div>

                        <div class="mb-3">
                            <label for="username">Dirección de Facturación</label>
                            <div class="input-group">
                              <textarea class="form-control" disabled id="validationTextarea">{{ ($ventas->facturacion != null )? $ventas->facturacion : 'Sin Direccion de Facturacion'  }} </textarea>
                            </div>
                          </div>
                  
                          <div class="mb-3">
                            <label for="email">Referencias de Facturación</label>
                            <textarea class="form-control" disabled id="validationTextarea">{{ ($ventas->referencia_facturacion != null )? $ventas->referencia_facturacion : 'Sin Referencias de facturacion'  }} </textarea>
                          </div>
                
                        
                
                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label for="country">Departamento</label>
                          <input type="text" class="form-control" disabled value="{{ $ventas->departamento }}">
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="state">Municipio</label>
                            <input type="text" class="form-control" disabled value="{{ $ventas->municipio }}">
                          </div>
                         
                        </div>
                       
                        <hr class="mb-4">
                
                        <h4 class="mb-3">Datos de Pago</h4>
                
                        
                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label for="cc-name">Método de Pago</label>
                            <input type="text" class="form-control" id="cc-name" value="{{ $ventas->metodo_pago }}" disabled>
                           
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="cc-number">Numero de Transacción del Cliente</label>
                            <input type="text" class="form-control" id="cc-number" value="{{ $ventas->numeroTransaccion }}" disabled>
                            
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label for="cc-expiration">Estado de la Venta</label>
                            <input type="text" class="form-control" id="cc-expiration" disabled value="@if($ventas->estadoVenta == 0)Pendiente de revisión @elseif($ventas->estadoVenta == 1)Aprobada @elseif ($ventas->estadoVenta == 2)Aprobación Manual @else Rechazada @endif">
                           
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
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Cerrar</button>
                @foreach ($detalle_venta as $d)
                @if ($d->estadoVenta == 1 || $d->estadoVenta == 3 || $d->estadoVenta == 2)
                    
                @else
                <button type="button" class="btn btn-primary" type="button" data-toggle="tooltip" data-placement="top" title="Aprobar venta" wire:click="ventaApproved(@js($d->id_venta))">Aprobar <i class="fe fe-check fe-16"></i></button>
                
                <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Rechazar venta" wire:click="ventaRejected(@js($d->id_venta))">Rechazar   <i class="fe fe-x fe-16"></i></button> 
                @endif
                  
                @endforeach
               
            </div>
          </div>
        </div>
      </div>
</div> 

@push('scripts')
<script>
  
   /* $('#tallaModal').on('hidden.bs.modal', function (e) {
        Livewire.emit('resetNamesTal');
    })*/

    window.addEventListener('closeModal', event => {
    $("#detalleVentaModal").modal('hide');  
      
      
    });

 

</script>
@endpush
