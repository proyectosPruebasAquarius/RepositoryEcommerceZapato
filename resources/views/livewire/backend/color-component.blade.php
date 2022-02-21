<div>
  <!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="colorModal" tabindex="-1" aria-labelledby="colorModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title col-11 text-center" id="colorModalLabel">
            @if ($id_color)
            Actualización de Color
            @else
            Nuevo Color
            @endif


          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form wire:submit.prevent="createData" id="formColor">


            <div class="form-group mb-2">
              <label for="asociado">Nombre</label>
              <br>
              <input id="nombre" type="text" placeholder="Nombre" class="form-control @error('nombre')
                 is-invalid
                 @enderror" wire:model="nombre">
                 @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
              <input type="hidden" wire:model="id_color">
              <label for="asociado">Color</label>
              <br>
              <input id="color" type="color" class="form-control @error('color')
                 is-invalid
                 @enderror" wire:model="color">
              @error('color') <span class="text-danger">{{ $message }}</span> @enderror
              <small class="form-text ">
                Seleccione el color
              </small>
            </div>
            @if ($id_color != null)
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
          <button type="submit" class="btn btn-primary" form='formColor'>
            @if ($id_color)
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
  $('#colorModal').on('hidden.bs.modal', function (e) {
             Livewire.emit('resetNamesTal');
         })
 
         window.addEventListener('closeModal', event => {
         $("#colorModal").modal('hide');  
           
           
         });
 
      
 
</script>
@endpush