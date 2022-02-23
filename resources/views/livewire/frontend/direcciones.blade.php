<div>
    <!-- Modal -->
    <div class="modal fade" id="direccionesModal" tabindex="-1" role="dialog" aria-labelledby="direccionesLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" {{-- style="background: #111111; color: #fff" --}}>
                <div class="modal-header  border-0">
                    <h5 class="modal-title" id="direccionesLabel">{{ $isFacturacion ? 'Dirección de Facturación' :
                        'Dirección de Envío' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="createOrUpdate" id="direccionesForm">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="direccion">Dirección</label>
                                <input type="text" class="form-control  @error('direccion') is-invalid @enderror" id="direccion" wire:model.lazy="direccion">
                                @error('direccion') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group col-12">
                                <label for="referencia">Dirección de referencia</label>
                                <input type="text" class="form-control  @error('referencia') is-invalid @enderror" id="referencia" wire:model.lazy="referencia">
                                @error('referencia') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group col-12 col-md-6">
                                <label for="departamentoD">Departamento</label>
                                <select class="form-control w-100
                                @error('idDepartamento')
                                is-invalid
                                @enderror
                                " id="departamentoD" wire:model.lazy="idDepartamento">
                                    @forelse ($departamentos as $departamento)
                                    @if($loop->first)
                                    <option >Seleccione un departamento</option>
                                    @endif
                                    <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                    @empty
                                    <option value="0">Ocurrio un error</option>
                                    @endforelse

                                </select>
                                @error('idDepartamento') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group col-12 col-md-6">
                                <label for="municipioD">Municipio</label>
                                <select class="form-control w-100
                                    @error('id_municipio')
                                    is-invalid
                                    @enderror
                                    " wire:model="id_municipio" id="municipioD">
                                    @forelse ($municipios as $municipio)
                                    @if($loop->first)
                                    <option>Seleccione un municipio</option>
                                    @endif
                                    <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                                    @empty
                                    <option>Seleccione un departamento</option>
                                    @endforelse

                                </select>
                                @error('id_municipio') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>

                            
                        </div>


                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{  $idDireccion ? 'Cancelar' : 'Cerrar' }}</button>
                    <button type="submit" class="btn btn-template" form="direccionesForm">{{  $idDireccion ? 'Actualizar' : 'Guardar' }}</button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        $('#direccionesModal').on('hidden.bs.modal', function (e) {
            Livewire.emit('cleanDirecciones');                
        });

        window.addEventListener('close-modal', function () {
            $('#direccionesModal').modal('hide');
        });        
        /* $('#direccionesModal').on('show.bs.modal', function (e) {
            Array.from(document.querySelectorAll('.nice-select')).forEach(e => {
                e.remove();
            });
            
            document.getElementById('departamentoD').removeAttribute('style');
            document.getElementById('municipioD').removeAttribute('style');
        }) */
        /* document.addEventListener('DOMContentLoaded', e => {
            $('#input-datalist').autocomplete()
        }, false); */

        /*  window.addEventListener('contentChanged', event => {
             $('#input-datalist').autocomplete()
             document.querySelectorAll('script').forEach(e => {
                 console.log(e.getAttribute('src'));
             })
            
         }); */

    </script>
    @endpush
</div>
