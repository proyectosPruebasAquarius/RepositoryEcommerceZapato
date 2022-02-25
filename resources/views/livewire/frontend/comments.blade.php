<div>
    <div class="row">
        <div class="col-12">
            <h4>Valoraciones</h4>
        </div>
    </div>
    <div class="row">
        <div class="col">
            {{-- <div class="row" >
                <div class="col-12 col-md-6">
                    <div class="placeholder-item"></div>
                </div>
            </div> --}}
            @forelse ($comentarios as $mR)
            <div class="row" >
                <div class="col-12 col-md-6 mx-auto">
                    {{-- <div class="placeholder-item"></div>  --}}                               
                    <div class="card w-auto h-auto border-0">
                        <div class="card-body">                        
                            <div class="rating">                            
                                <div class="row no-gutters">
                                    <div class="col-6">
                                        <img src="{{ asset('frontend/images/user.svg') }}" alt="{{ __('avatar') }}" class="rounded-lg" width="50" height="50">
                                    </div>
                                    @auth
                                        @if(auth()->user()->id_tipo_usuario === 1)
                                            <div class="col-6 text-right">
                                                <button class="btn rounded-circle success btn-sm" wire:click="$emit('assignVFR', @js($mR))" data-toggle="modal" data-target="#reviewsModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button class="btn rounded-circle danger btn-sm" wire:click="trash(@js($mR->id))"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </div>
                                        @endif
                                    @endauth
                                    {{-- <div class="col-6">
                                        <p>{{ __('Valoración: ').$mR->rating }}</p>
                                    </div> --}}
                                </div>
                                @php
                                    $user = explode(' ', $mR->usuario);
                                @endphp
                                <p class="date">{{ $user[0].' '.$user[1] }}</p>
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
                @guest
                    <p class="text-center">No se encontraron valoraciones para este producto, se el primero en valorar <b>Inicia Sesión</b>.</p>
                @else
                    @if(!$count)
                        <p class="text-center">No se encontraron valoraciones para este producto, se el primero en valorar.</p>
                    @endif
                @endguest
            @endforelse
        </div>
    </div>

    @push('scripts')
        <script>
            Livewire.on('reloadMyR', () => {
                Livewire.emit('reloadGeneral');
            })
        </script>
    @endpush
</div>
