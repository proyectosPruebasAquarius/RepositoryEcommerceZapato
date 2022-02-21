<div>
    
<div class="modal fade" id="colorModal" tabindex="-1" aria-labelledby="colorModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center col-11" id="colorModalLabel">Actualizacion de Color</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <form >
            <div class="form-group text-center  mb-2">
                <input type="hidden" wire:model="detalleColor">
                <label for="oldColorName">Color Seleccionado</label>
                <br>

               <label class="form-label">{{ $oldNameColor }}</label> &nbsp;
                <button class="btn" type="button" style="background-color: {{ $oldColor }}; height:25px;width:25px">

                  </button>
                  &nbsp;
                  <button type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Eliminar Color"
                    onclick="trashColor(@js($detalleColor))">
                    <i class="fe fe-trash fe-16 text-danger"></i>
                  </button>
            </div>





            <div class="form-group mb-2">
                <label for="updateColor">Color/es</label>
                <select  id="updateColor" class="form-control" wire:model="updateColor" class="form-control @error('updateColor')
                        is-invalid
                        @enderror">
                    <option selected style="display: none">Selecione el Color</option>


                    @forelse ($colores as $col)
                    <option value="{{ $col->id }}">
                       
                            {{ $col->nombre }}
                        
                        
                    </option>
                    @empty
                    <option>no hay opciones disponibles</option>
                    @endforelse
                </select>
                
            </div>
         </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" wire:click="updateColor">Actualizar</button>
        </div>
      </div>
    </div>
  </div>





 





</div>


@push('scripts')
<script>
         $('#colorModal').on('hidden.bs.modal', function (e) {
             Livewire.emit('resetNamesColor');
         })
 
         window.addEventListener('closeModal', event => {
         $("#colorModal").modal('hide');  
           
           
         });        
</script>
@endpush
