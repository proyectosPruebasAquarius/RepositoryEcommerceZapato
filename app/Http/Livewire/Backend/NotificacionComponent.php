<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;

class NotificacionComponent extends Component
{
    public  $noty = [];



    public function render()
    {
        $this->noty = auth()->user()->unreadNotifications;
        return view('livewire.backend.notificacion-component');
    }
}
