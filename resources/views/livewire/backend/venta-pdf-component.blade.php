<div>
    <div class="modal fade" id="ventaPDFModal" tabindex="-1" aria-labelledby="ventaPDFModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title col-11 text-center" id="ventaPDFModalLabel">Detalle de Venta por Fecha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:sumit.prevent="fechaPDF" id="ventaPDFForm">

                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="nombre" class="form-label">Fecha de la Venta</label>
                                <input type="date" id="nombre" class="form-control
                                @error('fecha')
                                  is-invalid  
                                @enderror                                                                                                
                                " wire:model="fecha">
                                @error('fecha') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" form="ventaPDFForm"
                        wire:click="fechaPDF">Consultar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>

window.addEventListener('closeModal', event => {
    $("#ventaPDFModal").modal('hide');  
      
      
    });
    $('#ventaPDFModal').on('hidden.bs.modal', function (e) {
             Livewire.emit('resetPDF');
    })
 

</script>
@endpush