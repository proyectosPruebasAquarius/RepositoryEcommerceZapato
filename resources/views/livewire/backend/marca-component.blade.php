<div>
    <!-- Button trigger modal -->
 
   
   <!-- Modal -->
   <div class="modal fade" id="marcaModal" tabindex="-1" aria-labelledby="marcaModalLabel" aria-hidden="true" wire:ignore.self>
     <div class="modal-dialog modal-dialog-centered">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title col-11 text-center" id="marcaModalLabel">
               @if ($id_marca)
               Actualización de Marca
               @else
               Nueva Marca
               @endif
              
             
             </h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
             <form wire:submit.prevent="createData" id="formMarca">
                 <div class="form-group">
                 <input type="hidden" wire:model="id_marca">
                 <input id="nombre" type="text" placeholder="Nombre" class="form-control @error('nombre')
                 is-invalid
                 @enderror" wire:model="nombre">
                 @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror     
                 </div>
                 @if ($id_marca != null)
                 <label for="estado">Estado</label>
                 <select id="estado" class="form-control" wire:model="estado">
                   @if ($estado == 0)
                     <option selected value="0">Desactivada</option>
                     <option value="1">Activar</option>
                   @else
                   <option selected value="1">Activa</option>
                   <option value="0">Desactivar</option>
                   @endif
                 </select>
                 @else
                 
                 @endif
                 
             </form>
            
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
           <button type="submit" class="btn btn-primary" form='formMarca'>
               @if ($id_marca)
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
       
         $('#marcaModal').on('hidden.bs.modal', function (e) {
             Livewire.emit('resetNamesMarca');
         })
 
         window.addEventListener('closeModal', event => {
         $("#marcaModal").modal('hide');  
           
           
         });
 
      
 
     </script>
 @endpush
 