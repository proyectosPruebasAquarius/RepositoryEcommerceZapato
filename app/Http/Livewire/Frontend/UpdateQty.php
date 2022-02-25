<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UpdateQty extends Component
{
    use LivewireAlert;
    public $cartItems = [];
    public $quantity = 1;
    public $maxQuantity = 1000;

    protected $listeners = ['realodQty' => '$refresh', 'updateQty' => 'updateCart'];
    
    public function updateCart($qty, $id)
    {
        
        try {
            /* $this->quantity = $qty; */
            if ($this->corroborate($this->cartItems['attributes']['id_inventario'], $qty)) {
                //\Debugbar::info($qty);
                if ($qty > 0) {
                    if ($id == $this->cartItems['id']) {
                        $this->cartItems['quantity'] = $qty;
                    }
                    \Cart::update($id, [
                        'quantity' => [
                            'relative' => false,
                            'value' => (int)$qty
                        ]
                    ]);
            
                    $this->emit('reloadCart');
                } else {
                    if ($id == $this->cartItems['id']) {
                        $this->cartItems['quantity'] = 1;
                    }
                }
                //$this->dispatchBrowserEvent('render-span', ['e' => $id]);
                /* return redirect(request()->header('Referer')); */
            } else {
                if ($id == $this->cartItems['id']) {
                    $this->alert('warning', 'No esta disponible la cantidad deseada.', [
                        'position' => 'center'
                    ]);
                }                
                /* \Debugbar::info($this->cartItems['attributes']['id_inventario']); */
            }
        } catch (\Exception $e) {
            //\Debugbar::info($e->getMessage());
            $this->alert('warning', 'Ocurrió un error inesperado, por favor intentelo de nuevo.', [
                'position' => 'center'
            ]);
        }
        
        
    }

    public function corroborate($id, $qty) 
    {
        $stock = \DB::table('inventarios')->where('id', $id)->value('stock');
        
        if ($qty <= $stock) {
            return true;
        } else {
            return false;
        }
    }
    
    public function mount($item)
    {
        /* \Debugbar::info('$qty'); */
        $this->cartItems = $item;

        $this->quantity = $item['quantity'];

        $this->maxQuantity = \DB::table('inventarios')->where('id', $item['attributes']['id_inventario'])->value('stock');
    }

    public function render()
    {
        return view('livewire.frontend.update-qty');
    }
}
