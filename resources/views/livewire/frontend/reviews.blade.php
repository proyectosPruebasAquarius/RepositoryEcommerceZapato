<div>
    <div class="row">
        <div class="col">
            <div class="contact__form">
                <form wire:submit.prevent="cOUReview">
                    <div class="row">
                        <div class="col-12">
                            <p style="position: absolute; color: #b7b7b7;">Valoración</p>
                        </div>
                        <div class="col-12 mt-1">
                            <div class='card_right__rating'>
                                <div class='card_right__rating__stars'>
                                    <fieldset class='rating'>
                                        {{-- usefully --}}
                                        <input id='star5' name='rating' type='radio' value='5' wire:model="rating">
                                        <label class='full' for='star5' title='5 estrellas'></label>
                                        <input id='star4half' name='rating' type='radio' value='4.5' wire:model="rating">
                                        <label class='half' for='star4half' title='4.5 estrellas'></label>
                                        <input id='star4' name='rating' type='radio' value='4' wire:model="rating">
                                        <label class='full' for='star4' title='4 estrellas'></label>
                                        <input id='star3half' name='rating' type='radio' value='3.5' wire:model="rating">
                                        <label class='half' for='star3half' title='3.5 estrellas'></label>
                                        <input id='star3' name='rating' type='radio' value='3' wire:model="rating">
                                        <label class='full' for='star3' title='3 estrellas'></label>
                                        <input id='star2half' name='rating' type='radio' value='2.5' wire:model="rating">
                                        <label class='half' for='star2half' title='2.5 estrellas'></label>
                                        <input id='star2' name='rating' type='radio' value='2' wire:model="rating">
                                        <label class='full' for='star2' title='2 estrellas'></label>
                                        <input id='star1half' name='rating' type='radio' value='1.5' wire:model="rating">
                                        <label class='half' for='star1half' title='1.5 estrellas'></label>
                                        <input id='star1' name='rating' type='radio' value='1' wire:model="rating">
                                        <label class='full' for='star1' title='1 estrella'></label>
                                        <input id='starhalf' name='rating' type='radio' value='0.5' wire:model="rating">
                                        <label class='half' for='starhalf' title='0.5 estrellas'></label>
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
                            <textarea placeholder="Descripción" wire:model.lazy="descripcion" maxlength="300" class="form-control mt-3 @error ('descripcion') invalid @enderror"></textarea>
                            <button type="submit" class="btn mt-3 mb-3">
                                Enviar Valoración
                                <div wire:loading wire:target="cOUReview">
                                    <div class="spinner-border text-light spinner-border-sm" role="status">
                                        <span class="sr-only">Loading...</span>                              
                                    </div>
                                </div>                        
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @if(count($myReviews))
        <div class="row">
            <div class="col">
                <h4>Mis Valoraciones</h4>
            </div>
        </div>
    @endif

    <div class="row" wire:loading.block wire:target="cOUReview">
        <div class="col-6 mx-auto">
            <div class="placeholder-item"></div>
        </div>
    </div>
    @forelse ($myReviews as $mR)
        <div class="row" wire:loading.remove wire:target="cOUReview">
            <div class="col-12 col-md-6 mx-auto">
                {{-- <div class="placeholder-item"></div>  --}}                               
                <div class="card w-auto h-auto border-0">
                    <div class="card-body">                        
                        <div class="rating">                            
                            <div class="row no-gutters">
                                <div class="col-6">
                                    <img src="{{ asset('frontend/images/user.svg') }}" alt="{{ auth()->user()->name }}" class="rounded-lg" width="50" height="50">
                                </div>
                                <div class="col-6 text-right">
                                    <button style="background: transparent" class="btn rounded-circle success btn-sm" wire:click="$emit('assignVFR', @js($mR))" data-toggle="modal" data-target="#reviewsModal"><i class="far fa-edit" aria-hidden="true"></i></button>
                                    <button style="background: transparent" class="btn rounded-circle danger btn-sm" wire:click="trash(@js($mR->id))"><i class="far fa-trash-alt" aria-hidden="true"></i></button>
                                </div>
                                {{-- <div class="col-6">
                                    <p>{{ __('Valoración: ').$mR->rating }}</p>
                                </div> --}}
                            </div>
                            <p class="date">{{ date('d-m-Y', strtotime($mR->created_at)) }}</p>
                            <i class=" @if ($mR->rating == 0.5) fad fa-star-half-alt @elseif($mR->rating >= 1) fas fa-star @else far fa-star @endif"></i>
                            <i class=" @if ($mR->rating == 1.5) fad fa-star-half-alt @elseif($mR->rating >= 2) fas fa-star @else far fa-star @endif"></i>
                            <i class=" @if ($mR->rating == 2.5) fad fa-star-half-alt @elseif($mR->rating >= 3) fas fa-star @else far fa-star @endif"></i>
                            <i class=" @if ($mR->rating == 3.5) fad fa-star-half-alt @elseif($mR->rating >= 4) fas fa-star @else far fa-star @endif"></i>
                            <i class=" @if ($mR->rating == 4.5) fad fa-star-half-alt @elseif($mR->rating == 5) fas fa-star @else far fa-star @endif"></i>  
                            <p>
                                @if($mR->title)
                                    <div class="row text-center">
                                        <div class="col">
                                            Titulo
                                        </div>                                    
                                    </div>
                                    <div class="row text-center">
                                        <div class="col text-muted">
                                            {{ $mR->title }}
                                        </div>
                                    </div>
                                @endif

                                @if($mR->descripcion)
                                    <div class="row text-center">
                                        <div class="col">
                                            Descripción
                                        </div>
                                    </div>
                                    <div class="row text-center">
                                        <div class="col">
                                            {{ $mR->descripcion }}
                                        </div>
                                    </div>
                                @endif
                            </p>                          
                        </div> 
                        <hr>                       
                    </div>
                </div>                
            </div>
        </div>
    @empty
                
    @endforelse
    
    @push('scripts')
    <script>
        function goToForm(data) {
            $('html,body').animate({
                scrollTop: $(".contact__form").offset().top},
            'slow');

            @this.assignValues(data);
        }
    </script>
    @endpush
</div>