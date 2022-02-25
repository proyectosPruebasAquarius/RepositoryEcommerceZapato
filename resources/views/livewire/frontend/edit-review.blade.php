<div>
    <!-- Modal -->
    <div class="modal fade" id="reviewsModal" tabindex="-1" role="dialog" aria-labelledby="reviewsModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="reviewsModalLabel">Actualizar valoración</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="contact__form">
                        <form wire:submit.prevent="cOUReview" id="updateReviews">
                            <div class="row">
                                <div class="col-12">
                                    <p style="position: absolute; color: #b7b7b7;">Valoración</p>
                                </div>
                                <div class="col-12 mt-1">
                                    <div class='card_right__rating'>
                                        <div class='card_right__rating__stars'>
                                            <fieldset class='rating'>
                                                {{-- usefully --}}
                                                <input id='star25' name='rating' type='radio' value='5.0' wire:model="rating">
                                                <label class='full' for='star25' title='5 estrellas'></label>
                                                <input id='star24half' name='rating' type='radio' value='4.5' wire:model="rating">
                                                <label class='half' for='star24half' title='4.5 estrellas'></label>
                                                <input id='star24' name='rating' type='radio' value='4.0' wire:model="rating">
                                                <label class='full' for='star24' title='4 estrellas'></label>
                                                <input id='star23half' name='rating' type='radio' value='3.5' wire:model="rating">
                                                <label class='half' for='star23half' title='3.5 estrellas'></label>
                                                <input id='star23' name='rating' type='radio' value='3.0' wire:model="rating">
                                                <label class='full' for='star23' title='3 estrellas'></label>
                                                <input id='star22half' name='rating' type='radio' value='2.5' wire:model="rating">
                                                <label class='half' for='star22half' title='2.5 estrellas'></label>
                                                <input id='star22' name='rating' type='radio' value='2.0' wire:model="rating">
                                                <label class='full' for='star22' title='2 estrellas'></label>
                                                <input id='star21half' name='rating' type='radio' value='1.5' wire:model="rating">
                                                <label class='half' for='star21half' title='1.5 estrellas'></label>
                                                <input id='star21' name='rating' type='radio' value='1.0' wire:model="rating">
                                                <label class='full' for='star21' title='1 estrella'></label>
                                                <input id='star2half1' name='rating' type='radio' value='0.5' wire:model="rating">
                                                <label class='half' for='star2half1' title='0.5 estrellas'></label>
                                            </fieldset>
                                        </div>
                                    </div>
                                    @error('rating') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col">
                                    @error('title') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12">
                                    <input type="text" placeholder="Titulo" wire:model.lazy="title" maxlength="100" class="form-control @error ('title') invalid @enderror">                    
                                </div>
                                <div class="col">
                                    @error('descripcion') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12">
                                    <textarea placeholder="Descripción" wire:model.lazy="descripcion" maxlength="300" class="form-control @error ('descripcion') invalid @enderror"></textarea>
                                    {{-- <button type="submit" class="site-btn mb-3">
                                        Enviar Valoración
                                        <div wire:loading wire:target="cOUReview">
                                            <div class="spinner-border text-light spinner-border-sm" role="status">
                                                <span class="sr-only">Loading...</span>                              
                                            </div>
                                        </div>                        
                                    </button> --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn" form="updateReviews">
                        Actualizar
                        <div wire:loading wire:target="cOUReview">
                            <div class="spinner-border text-light spinner-border-sm" role="status">
                                <span class="sr-only">Loading...</span>                              
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>        
        $('#reviewsModal').on('hide.bs.modal', function (e) {
            @this.resetData();
        })

        window.addEventListener('close-modal', function () {
            $('#reviewsModal').modal('hide')
        })
    </script>
    @endpush
</div>