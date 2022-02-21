<div>
    <!-- Button trigger modal -->
 
   
   <!-- Modal -->
   <div class="modal fade" id="estiloModal" tabindex="-1" aria-labelledby="estiloModalLabel" aria-hidden="true" wire:ignore.self>
     <div class="modal-dialog modal-dialog-centered">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title col-11 text-center" id="estiloModalLabel">
               @if ($id_estilo)
               Actualización de Estilo
               @else
               Nuevo Estilo
               @endif
              
             
             </h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
             <form wire:submit.prevent="createData" id="formEstilo">
                 <div class="form-group">
                 <input type="hidden" wire:model="id_estilo">
                 <input id="nombre" type="text" placeholder="Nombre" class="form-control @error('nombre')
                 is-invalid
                 @enderror" wire:model="nombre">
                 @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror     
                 </div>
                 @if ($id_estilo != null)
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
           <button type="submit" class="btn btn-primary" form='formEstilo'>
               @if ($id_estilo)
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
       
         $('#estiloModal').on('hidden.bs.modal', function (e) {
             Livewire.emit('resetNamesTal');
         })
 
         window.addEventListener('closeModal', event => {
         $("#estiloModal").modal('hide');  
           
           
         });
 
      
 
     </script>
 @endpush
 