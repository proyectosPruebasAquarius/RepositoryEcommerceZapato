<div>
    <!-- Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
            <h5 class="modal-title" id="profileModalLabel">Editar Perfil</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="row" wire:submit.prevent="updateUser" id="updatedUser">
                    @csrf
                    <div class="form-group col-12">
                        <label for="usuarios">Nombre Completo</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="usuarios" value="{{ auth()->user()->name }}" wire:model.lazy="name" required>
                        @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    {{-- <div class="form-group col">
                        <label for="correo">Correo Eléctronico</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="correo" value="{{ auth()->user()->email }}" wire:model.lazy="email" required>
                        @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div> --}}
                    <div class="form-group col-12">
                        <label for="numeroTel">Teléfono</label>
                        <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="numeroTel" value="{{ auth()->user()->telefono }}" wire:model.lazy="telefono">
                        @error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn" style="color: #fff; background: #111111" form="updatedUser">Actualizar</button>
            </div>
        </div>
        </div>
    </div>

    @push('scripts')
        <script>
            'use strict';
            $('#profileModal').on('hide.bs.modal', function (e) {
                @this.cleanValidation();
            })
        </script>
    @endpush
</div>
