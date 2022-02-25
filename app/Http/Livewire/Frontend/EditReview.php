<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Review;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class EditReview extends Component
{
    use LivewireAlert;
    public $id_opinion;
    public $rating;
    public $title;
    public $descripcion;
    public $id_producto;
    public $id_usuario;

    protected $listeners = ['assignVFR' => 'assignValues'];

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
            Review::findOrFail($this->id_opinion)->update($validatedData);
            $this->dispatchBrowserEvent('close-modal');
            $this->emit('reloadMyR');
            $this->alert('success', 'Valoración actualizada con éxito.', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
        } catch (\Exception $e) {
            $this->alert('error', 'Ocurrió un error, por favor intentalo de nuevo.', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
        }
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

    public function resetData()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset(['rating', 'title', 'descripcion', 'id_opinion', 'id_producto']);
    }

    public function render()
    {
        return view('livewire.frontend.edit-review');
    }
}
