<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class CartSection extends Component
{    
    protected $listeners = ['cartUpdated' => '$refresh'];
    
    public function removeCart($id)
    {        
        \Cart::remove($id);  
        //session()->flash('success', 'Item has removed !');
    }

    public function render()
    {
        $this->dispatchBrowserEvent('reload-scrollBar');
        $unsort = \Cart::getContent()->toArray();
        $sort = array_multisort(array_map(function($element) {
            return $element['id'];
        }, $unsort), SORT_DESC, $unsort);

        /* \Debugbar::info($unsort); */
        return view('livewire.frontend.cart-section', [
            'cart' => $unsort,
        ]);
    }
}
