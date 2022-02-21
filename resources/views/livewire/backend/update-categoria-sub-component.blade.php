<div>
    <div class="modal fade" id="catModal" tabindex="-1" aria-labelledby="catModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-center col-11" id="catModalLabel">Actualizacion de Categoria y Sub Categoria</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <form >
                <div class="form-group text-center  mb-2">
                    <input type="hidden" wire:model="detalleColor">
                    <label for="oldColorName">Categoria y Sub Categoria Seleccionada</label>
                    <br>
    
                   <label class="form-label">{{ $oldCategoria }} / {{ $oldSub }}</label> &nbsp;
                    
                    
                </div>
    
    
    
    
    
                <div class="form-group mb-2">
                    <label for="categoria">Categoria</label>
                    <select id="categoria" class="form-control" wire:model="categoria" class="form-control ">
                        <option selected style="display: none">Selecione la Categoria</option>


                        @forelse ($categorias as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                        @empty
                        <option>no hay opciones disponibles</option>
                        @endforelse
                    </select>
                    
                </div>


                <div class="form-group mb-2">
                    <label for="subcat">Sub Categoria</label>
                    <select id="subcat" class="form-control" wire:model="subcat" class="form-control @error('subcat')
                        is-invalid
                        @enderror">
                        <option selected style="display: none">Selecione la Sub Categoria</option>


                        @forelse ($sub_categorias as $scat)
                        <option value="{{ $scat->id }}">{{ $scat->nombre }}</option>
                        @empty
                        <option>no hay opciones disponibles</option>
                        @endforelse
                    </select>
                    @error('subcat') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
             </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" wire:click="updateCat">Actualizar</button>
            </div>
          </div>
        </div>
      </div>
</div>


@push('scripts')
<script>    
         $('#catModal').on('hidden.bs.modal', function (e) {
             Livewire.emit('resetNamesTalla');
         })
 
         window.addEventListener('closeModal', event => {
         $("#catModal").modal('hide');  
                      
         });              
</script>
@endpush
