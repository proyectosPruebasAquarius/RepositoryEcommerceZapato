<div>
    <div class="modal fade" id="pedidosModal" tabindex="-1" aria-labelledby="pedidosModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title col-11 text-center" id="pedidosModalLabel">Edicion de
                Pedido de Proveedor</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form >
                 
                  <div class="row">
                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="name" class="form-label">Código del Producto </label>

                            <input type="text" id="name" class="form-control" wire:model="codigo_producto"
                                disabled>

                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="imagen" class="form-label">Producto</label>
                            <input type="text" id="name" class="form-control" wire:model="producto"
                                 disabled>

                        </div>
                    </div>
                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="imagen" class="form-label">Precio de Compra</label>
                            <input type="text" id="name" class="form-control
                                
                            @error('precio_compra')  is-invalid @enderror
                            " wire:model="precio_compra"
                                 name="precio_compra">
                                 @error('precio_compra') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="imagen" class="form-label">Proveedor</label>
                            <input type="text" id="name" class="form-control" wire:model="proveedor"
                                 disabled>

                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="imagen" class="form-label">Dirección del Proveedor</label>
                            <textarea cols="4" rows="2" class="form-control" wire:model="direc_proveedor"
                                disabled></textarea>

                        </div>
                    </div>
                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="imagen" class="form-label">Telefono del Proveedor</label>
                            <input type="text" id="name" class="form-control" wire:model="tel_proveedor"
                                 disabled>

                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="imagen" class="form-label">Contacto del Proveedor</label>
                            <input type="text" id="name" class="form-control" wire:model="contacto"
                                 disabled>

                        </div>
                    </div>
                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="imagen" class="form-label">Telefono del Contacto</label>
                            <input type="text" id="name" class="form-control" wire:model="tel_contacto"
                                 disabled>

                        </div>
                    </div>
                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="imagen" class="form-label">Estado del Proveedor</label>
                            @if ($estado_proveedor == 1)
                            <input type="text" id="name" class="form-control" value="Activo" disabled>
                            @else
                            <input type="text" id="name" class="form-control" value="Desactivado" disabled>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="imagen" class="form-label">Fecha de Entrega</label>
                            <input type="date" id="name" class="form-control" name="fecha_entrega" wire:model="fecha_entrega"
                            >
                            @if ( $fecha_entrega == null )                           
                            <div class="form-text">
                                No hay fecha de entrega para este pedido
                            </div>                                                       
                            @endif


                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="imagen" class="form-label">Estado del Pedido</label>
                            <select name="estado_pedido" class="form-control" wire:model="estado_pedido">
                             
                                <option value="0">Pendiente de Pedido</option>
                                <option value="1">Pedido Realizado</option>
                                <option value="2">Producto no Fabricado</option>
                                <option value="3">Proveedor no Activo</option>
                               
                            </select>

                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="imagen" class="form-label">Cantidad del Producto</label>
                            <input type="number" id="name" name="cantidad" class="form-control  @error('cantidad') is-invalid @enderror" wire:model="cantidad">
                            @error('cantidad') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                  
                </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" wire:click="UpdPedido">Actualizar</button>
            </div>
          </div>
        </div>
      </div>
</div>
 
@push('scripts')
<script>
  
    $('#pedidosModal').on('hidden.bs.modal', function (e) {
        Livewire.emit('resetNamesPedido');
    })

    window.addEventListener('closeModal', event => {
    $("#pedidosModal").modal('hide');  
      
      
    });

 

</script>
@endpush
