<div>
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="inventarioModal" tabindex="-1" aria-labelledby="inventarioModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title col-11 text-center" id="inventarioModalLabel">
                        @if ($id_inventario)
                        Actualización de Inventario
                        @else
                        Nuevo Inventario
                        @endif


                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="createData" id="formInventario">
                        <div class="form-group  mb-2">
                            <input type="hidden" wire:model="id_producto">
                            <label for="precio_compra">Precio de Compra</label>
                            <input id="precio_compra" type="text" placeholder="precio de compra" class="form-control @error('precio_compra')
                 is-invalid
                 @enderror" wire:model="precio_compra">
                            @error('precio_compra') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="precio_venta">Precio Venta</label>
                            <input id="precio_venta" type="text" placeholder="precio de venta" class="form-control @error('precio_venta')
                    is-invalid
                    @enderror" wire:model="precio_venta">
                            @error('precio_venta') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="stock">Stock</label>
                            <input id="stock" type="text" placeholder="Stock" class="form-control @error('stock')
                        is-invalid
                        @enderror" wire:model="stock">
                            @error('stock') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="stock_min">Stock Minimo</label>
                            <input id="stock_min" type="text" placeholder="Stock minimo" class="form-control @error('stock_min')
                        is-invalid
                        @enderror" wire:model="stock_min">
                            @error('stock_min') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="producto">Producto</label>
                            <select id="producto" class="form-control" wire:model="producto" class="form-control @error('producto')
                            is-invalid
                            @enderror">
                                <option selected style="display: none">Selecione el producto</option>


                                @forelse ($productos as $pro)
                                <option value="{{ $pro->id }}">{{ $pro->cod }}</option>
                                @empty
                                <option>no hay opciones disponibles</option>
                                @endforelse
                            </select>
                            @error('producto') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>


                        <div class="form-group mb-2">
                            <label for="descuento">Descuento</label>
                            <select id="descuento" class="form-control" wire:model="descuento" class="form-control @error('descuento')
                            is-invalid
                            @enderror">
                                <option selected style="display: none">Selecione el descuento</option>
                                <option value="0" >Sin descuento</option>

                                @forelse ($ofertas as $mar)
                                <option value="{{ $mar->id }}">{{ $mar->nombre }}</option>
                                @empty
                                <option>no hay opciones disponibles</option>
                                @endforelse
                            </select>
                            @error('descuento') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>



                        @if ($id_inventario != null)
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
                    <button type="submit" class="btn btn-primary" form='formInventario'>
                        @if ($id_inventario)
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
    $('#inventarioModal').on('hidden.bs.modal', function (e) {
             Livewire.emit('resetNamesInventario');
         })
 
         window.addEventListener('closeModal', event => {
         $("#inventarioModal").modal('hide');  
           
           
         });
 
      
 
</script>
@endpush