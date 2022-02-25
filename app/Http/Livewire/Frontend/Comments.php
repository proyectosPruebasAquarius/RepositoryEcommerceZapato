<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Review;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Comments extends Component
{
    use LivewireAlert;
    public $id_producto;
    public $id_opinion;

    protected $listeners = ['reloadGeneral' => '$refresh', 'confirmedA', 'cancelledA'];

    public function trash($id)
    {        
        $this->alert('question', '¿Estas seguro que deseas eliminar la valoración?', [
            'position' => 'center',
            'allowOutsideClick' => false,
            'timer' => null,
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmedA',
            'showCancelButton' => true,
            'onDismissed' => 'cancelledA',
            'cancelButtonText' => 'Cancelar',
            'confirmButtonText' => 'Aceptar',                          
            'text' => 'Esta acción es irreversible',
        ]);

        $this->id_opinion = $id;           
    }

    public function confirmedA()
    {
        try {
            Review::findOrFail($this->id_opinion)->delete();
            $this->alert('success', 'Valoración eliminada con éxito.', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
            $this->cancelledA();
            $this->emitSelf('reloadGeneral');
        } catch (\Exception $e) {
            //\Debugbar::info($e->getMessage());
            $this->alert('error', 'Ocurrió un error, por favor intentalo de nuevo.', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
        }
    }

    public function cancelledA() 
    {
        $this->reset('id_opinion');
    }

    public function mount($id)
    {
        $this->id_producto = $id;
    }

    public function render()
    {
        $isAuth = auth()->check();
        $comments = Review::join('users', 'opiniones.id_usuario', '=', 'users.id')->where('id_producto', $this->id_producto)->when($isAuth, function ($query) {
            $query->where('id_usuario', '!=', auth()->user()->id);
        })->select('opiniones.*', 'users.name as usuario')->get();

        $count = 0;
        if ($isAuth) {
            $count = Review::where([
                ['id_usuario', auth()->user()->id],
                ['id_producto', $this->id_producto]
            ])->count();
        }
        return view('livewire.frontend.comments', [
            'comentarios' => $comments,
            'count' => $count,
        ]);
    }
}
