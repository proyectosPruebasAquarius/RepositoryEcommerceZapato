<div>
    <div class="modal fade" id="tallaModal" tabindex="-1" aria-labelledby="tallaModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-center col-11" id="tallaModalLabel">Actualizacion de Talla</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <form >
                <div class="form-group text-center  mb-2">
                    <input type="hidden" wire:model="detalleColor">
                    <label for="oldColorName">Talla Seleccionada</label>
                    <br>
    
                   <label class="form-label">{{ $oldTalla }}</label> &nbsp;
                    
                      &nbsp;
                      <button type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Eliminar Talla"
                        onclick="trashTalla(@js($detalleTalla))">
                        <i class="fe fe-trash fe-16 text-danger"></i>
                      </button>
                </div>
    
    
    
    
    
                <div class="form-group mb-2">
                    <label for="updateTalla">Talla/s</label>
                    <select  id="updateTalla" class="form-control" wire:model="updateTalla" class="form-control">
                        <option selected style="display: none">Selecione la/s Colores</option>
    
    
                        @forelse ($tallas as $ta)
                        <option value="{{ $ta->id }}">{{ $ta->nombre }}</option>
                        @empty
                        <option>no hay opciones disponibles</option>
                        @endforelse
                    </select>
                    
                </div>
             </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" wire:click="updateTalla">Actualizar</button>
            </div>
          </div>
        </div>
      </div>
</div>


@push('scripts')
<script>    
         $('#tallaModal').on('hidden.bs.modal', function (e) {
             Livewire.emit('resetNamesTalla');
         })
 
         window.addEventListener('closeModal', event => {
         $("#tallaModal").modal('hide');  
                      
         });              
</script>
@endpush
