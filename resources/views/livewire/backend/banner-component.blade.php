<div>
    <div class="modal fade" id="bannerModal" tabindex="-1" aria-labelledby="bannerModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title col-11 text-center" id="bannerModalLabel">
                        @if ($id_banner != null)
                        Actualizar Banner
                        @else
                        Nuevo Banner
                        @endif
                       
                    
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="
                    @if ($id_banner != null)
                    updateData
                    @else
                    createData
                    @endif

                   
                    
                    " id="bannerForm">

                        <div class="form-group">
                            <input type="hidden" wire:model="id_banner">
                            <label for="titulo">Titulo</label>
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" aria-describedby="titulo"
                                wire:model="titulo" placeholder="Titulo">
                            @error('titulo') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="titulo">Sub Titulo</label>
                            <input type="text" class="form-control @error('sub_titulo') is-invalid @enderror" id="subtitulo" aria-describedby="subtitulo"
                                wire:model="sub_titulo" placeholder="Sub Titulo">
                            @error('sub_titulo') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="descripcionArea">Descripción</label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcionArea" rows="3"
                                wire:model="descripcion"></textarea>
                            @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="ImageBanner">Imagen del Banner</label>
                            <input type="file" class="form-control-file @error('imagen') is-invalid @enderror" id="ImageBanner" wire:model="imagen">
                            @error('imagen') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" form="bannerForm">
                        @if ($id_banner != null)
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
    $('#bannerModal').on('hidden.bs.modal', function (e) {
        Livewire.emit('resetNamesBanner');
    })

    window.addEventListener('closeModal', event => {
    $("#bannerModal").modal('hide');  
      
      
    });

 

</script>
@endpush