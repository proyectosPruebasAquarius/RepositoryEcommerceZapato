<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class Cart extends Component
{
    protected $listeners = ['reloadCart' => '$refresh'];

    public function removeFromCart($id)
    {
        \Cart::remove($id);
        $this->emitSelf('reloadCart');
        if (\Cart::isEmpty())
        return redirect()->to('/productos');
    }

    public function render()
    {
        $cart = \Cart::getContent()->toArray();
        array_multisort(array_map(function($element) {
            return $element['id'];
        }, $cart), SORT_DESC, $cart);

        return view('livewire.frontend.cart', [
            'cart' => $cart
        ]);
    }
}
