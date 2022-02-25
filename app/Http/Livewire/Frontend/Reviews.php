<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Review;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Reviews extends Component
{
    use LivewireAlert;
    public $id_opinion;
    public $rating;
    public $title;
    public $descripcion;
    public $id_producto;
    public $id_usuario;

    protected $listeners = ['reloadMyR' => '$refresh', 'confirmed', 'cancelled'];

    protected $rules = [
        'rating' => 'required',
        'title' => 'nullable|string|min:4|max:100',
        'descripcion' => 'nullable|string|min:4|max:300',
        'id_producto' => 'required',
        'id_usuario' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function cOUReview()
    {
        $validatedData = $this->validate();
        /* \Debugbar::info($validatedData); */
        try {
            Review::create($validatedData);
            $this->resetData();
            $this->emitSelf('reloadMyR');
        } catch (\Exception $e) {
            $this->alert('error', 'Ocurrió un error, por favor intentalo de nuevo.', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
        }
    }

    public function resetData()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset(['rating', 'title', 'descripcion']);
    }

    public function trash($id)
    {        
        $this->alert('question', '¿Estas seguro que deseas eliminar la valoración?', [
            'position' => 'center',
            'allowOutsideClick' => false,
            'timer' => null,
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmed',
            'showCancelButton' => true,
            'onDismissed' => 'cancelled',
            'cancelButtonText' => 'Cancelar',
            'confirmButtonText' => 'Aceptar',                          
            'text' => 'Esta acción es irreversible',
        ]);

        $this->id_opinion = $id;           
    }

    public function confirmed()
    {
        try {
            Review::findOrFail($this->id_opinion)->delete();
            $this->alert('success', 'Valoración eliminada con éxito.', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
            $this->cancelled();
            $this->emitSelf('reloadMyR');
        } catch (\Exception $e) {
            $this->alert('error', 'Ocurrió un error, por favor intentalo de nuevo.', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
        }
    }

    public function cancelled() 
    {
        $this->reset('id_opinion');
    }

    public function assignValues($data)
    {
        $this->id_opinion = $data['id'];
        $this->rating = $data['rating'];
        $this->title = $data['title'];
        $this->descripcion = $data['descripcion'];
        $this->id_usuario = $data['id_usuario'];
        $this->id_producto = $data['id_producto'];
    }

    public function mount($id)
    {
        $this->id_producto = $id;
        $this->id_usuario = auth()->user()->id;
    }

    public function render()
    {
        /* \Debugbar::info($this->id_opinion); */
        $myReviews = Review::where([
            ['id_producto', $this->id_producto],
            ['id_usuario', $this->id_usuario],
        ])->get();

        return view('livewire.frontend.reviews', [
            'myReviews' => $myReviews,
        ]);
    }
}
