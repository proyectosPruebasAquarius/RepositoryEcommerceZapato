<div>
    <div class="modal fade" id="pedidosPDFModal" tabindex="-1" aria-labelledby="pedidosPDFModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title col-11 text-center" id="pedidosPDFModalLabel">Descarga de PDF de
                Pedidos de Proveedores</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form>
                   
                    <div class="mb-3">
                        <label for="FechaIncio" class="form-label">Fecha de Inicio</label>
                        <input type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" id="FechaIncio"
                            name="fecha_inicio" wire:model="fecha_inicio">
                            @error('fecha_inicio') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="FechaFin" class="form-label">Fecha de Fin</label>
                        <input type="date" class="form-control" id="FechaFin"
                            name="fecha_fin" wire:model="fecha_fin">
                           
                    </div>
                    <div id="emailHelp" class="form-text"><strong>Selecciona la Fecha ó Fechas de las cuales deseas optener los datos</strong>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:target="pedidoPDF" wire:loading.attr="disabled">Cerrar</button>

              <button type="button" class="btn btn-primary" wire:click="pedidoPDF" wire:loading.class="d-none">
                <div wire:loading wire:target="pedidoPDF">
                  <div class="spinner-border spinner-border-sm text-light" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
              </div>
                
                &nbsp;
                Descargar PDF</button>


               
                  <div wire:loading wire:target="pedidoPDF">
                    <button type="button" class="btn btn-primary" >
                    <div class="spinner-border spinner-border-sm text-light" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                    &nbsp;
                    Descargando PDF</button>
                </div>
                  
                 



            </div>
          </div>
        </div>
      </div>
</div>
@push('scripts')
<script>
  
    $('#pedidosPDFModal').on('hidden.bs.modal', function (e) {
        Livewire.emit('resetDates');
    })

    window.addEventListener('closeModal', event => {
    $("#pedidosPDFModal").modal('hide');  
      
      
    });

 

</script>
@endpush