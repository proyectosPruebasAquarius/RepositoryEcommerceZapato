<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\User;

class EditProfile extends Component
{
    public $name;
    /* public $email; */
    public $telefono;
    public $id_user;

    protected $rules = [
        'name' => 'required|string|min:6|max:200',
        /* 'email' => 'required|string', */
        'telefono' => 'nullable|string|min:8|max:12',
        'id_user' => 'required'
    ];

    public function updated($propertyName) 
    {
        $this->validateOnly($propertyName);
    }

    public function updateUser()
    {
        try {
            $validation = $this->validate();

            $user = User::findOrFail($validation['id_user']);
            $user->update($validation);
            return redirect(request()->header('Referer'));
        } catch (\Exception $e) {
            
        }
    }

    public function mount()
    {
        $this->id_user = auth()->user()->id;
        $this->name = auth()->user()->name;
        /* $this->email = auth()->user()->email; */
        $this->telefono = auth()->user()->telefono;
        
        if (empty($this->id_user)) {
            return redirect()->to('/');
        }
    }

    public function cleanValidation() 
    {
        $this->resetErrorBag();

        $this->resetValidation();
        
        $this->id_user = auth()->user()->id;
        $this->name = auth()->user()->name;
        /* $this->email = auth()->user()->email; */
        $this->telefono = auth()->user()->telefono;
    }

    public function render()
    {
        return view('livewire.frontend.edit-profile');
    }
}
