<div>
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="metodoModal" tabindex="-1" aria-labelledby="metodoModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title col-11 text-center" id="metodoModalLabel">
                        @if ($id_metodo)
                        Actualización de Metodo de Pago
                        @else
                        Nuevo Metodo de Pago
                        @endif


                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="createData" id="formMetodo">
                        <div class="form-group  mb-2">
                            <input type="hidden" wire:model="id_metodo">
                            <label for="nombre">Nombre del Método de Pago</label>
                            <input id="nombre" type="text" placeholder="Método de pago" class="form-control @error('nombre')
         is-invalid
         @enderror" wire:model="nombre">
                            @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="numero">Número de Cuenta Bancaria, Célular o Bitcoin (Chivo Wallet)</label>
                            <input id="numero" type="text" placeholder="Escriba el número de cuenta o célular" class="form-control @error('numero')
            is-invalid
            @enderror" wire:model="numero">
                            @error('numero') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="qr">Código QR</label>
                            <input id="qr" type="file"    accept="image/*" multiple class="form-control-file @error('qr')
                is-invalid
                @enderror   " wire:model="qr">
                            @error('qr') <span class="text-danger">{{ $message }}</span> @enderror
                            @error('qr.*') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="asociado">Nombre del Asociado a la Cuenta</label>
                            <input id="asociado" type="text" placeholder="Nombre del asociado" class="form-control @error('asociado')
                is-invalid
                @enderror" wire:model="asociado">
                            @error('asociado') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        

                        @if ($id_metodo != null)
                        <div class="form-group mb-2">
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
                        </div>
                        <div class="form-group mb-2 text-center">
                            <label for="estado" class="form-text">Imagenes Actuales</label>
                            <br>
                            @foreach (json_decode($oldImg) as $img)
                            <img src="{{ asset('/storage/images/metodos_pagos/'.$img)}}" alt="" class="img-responsive w-25">
                            @endforeach
                        </div>
                        <input type="hidden" wire:model="oldImg">   
                                              
                        @else
                       
                        @endif

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" form='formMetodo'>
                        @if ($id_metodo)
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
    $('#metodoModal').on('hidden.bs.modal', function (e) {
             Livewire.emit('resetNamesMetodo');
         })
 
         window.addEventListener('closeModal', event => {
         $("#metodoModal").modal('hide');  
           
           
         });
 
      
 
</script>
@endpush