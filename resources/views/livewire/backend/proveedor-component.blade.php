<div>
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="proveedorModal" tabindex="-1" aria-labelledby="proveedorModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title col-11 text-center" id="proveedorModalLabel">
                        @if ($id_proveedor)
                        Actualización de Proveedor
                        @else
                        Nueva Proveedor
                        @endif


                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="createData" id="formProveedor">
                        <div class="form-group  mb-2">
                            <input type="hidden" wire:model="id_proveedor">
                            <label for="nombre">Nombre del Proveedor</label>
                            <input id="nombre" type="text" placeholder="Nombre" class="form-control @error('nombre')
                 is-invalid
                 @enderror" wire:model="nombre">
                            @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="telefono">Telefono del Proveedor</label>
                            <input id="telefono" type="text" placeholder="Telefono" class="form-control @error('telefono')
                    is-invalid
                    @enderror" wire:model="telefono">
                            @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="direccion">Direccion del Proveedor</label>
                            <input id="direccion" type="text" placeholder="Dirección" class="form-control @error('direccion')
                        is-invalid
                        @enderror" wire:model="direccion">
                            @error('direccion') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="contacto">Nombre del Contacto</label>
                            <input id="contacto" type="text" placeholder="Nombre del Contacto" class="form-control @error('contacto')
                        is-invalid
                        @enderror" wire:model="contacto">
                            @error('contacto') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="contacto">Telefono del Contacto</label>
                            <input id="telcontacto" type="text" placeholder="Telefono del Contacto" class="form-control @error('telcontacto')
                    is-invalid
                    @enderror" wire:model="telcontacto">
                            @error('telcontacto') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        @if ($id_proveedor != null)
                        <label for="estado">Estado</label>
                        <select id="estado" class="form-control" wire:model="estado">
                            @if ($estado == 0)
                            <option selected value="0">Desactivado</option>
                            <option value="1">Activar</option>
                            @else
                            <option selected value="1">Activo</option>
                            <option value="0">Desactivar</option>
                            @endif
                        </select>
                        @else

                        @endif

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" form='formProveedor'>
                        @if ($id_proveedor)
                        Actualizar
                        @else
                        Guardar
                        @endif

                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
    $('#proveedorModal').on('hidden.bs.modal', function (e) {
             Livewire.emit('resetNamesProveedor');
         })
 
         window.addEventListener('closeModal', event => {
         $("#proveedorModal").modal('hide');  
           
           
         });
 
      
 
</script>
@endpush