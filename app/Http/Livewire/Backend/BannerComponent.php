<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Banner;
use Illuminate\Support\Facades\File; 
use DB;
class BannerComponent extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    public $id_banner,$imagen,$titulo,$sub_titulo,$descripcion,$old_img;

    protected $listeners = ['resetNamesBanner' => 'resetInput','asignBanner' => 'asignBanner','dropByStateBanner'=>'dropBanner'];

    protected $rules = [
        
        'titulo' => 'required',
        'descripcion' => 'required'

    ];
    
    protected $messages = [
        'imagen.required' => 'La Imagen es Obligatoria',
        'imagen.image' => 'Archivo no valido, Debe ser una imagen',
        'imagen.mines' => 'Formato no valido',
        'titulo.required' => 'El titulo es Obligatorio',
        'descripcion.required' => 'La Descripción es Obligatoria',

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetInput()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset(['imagen','titulo','sub_titulo','descripcion','id_banner']);
    }

    public function asignBanner($banner)
    {
        $this->id_banner = $banner['id_banner'];
        $this->descripcion = $banner['descripcion'];
        $this->sub_titulo = $banner['sub_titulo'];
        $this->titulo = $banner['titulo'];
        $this->old_img = $banner['imagen'];
    }


    public function createData()
    {        
        if ($this->id_banner != null) {
            $this->rules = [

                'imagen' => ['required','image', 'mimes:jpeg,png,jpg,gif,svg,webp'],
                'titulo' => 'required',
                'descripcion' => 'required'
            ];
        } else {

        }
        $this->validate();

      
            try {
                $extension = $this->imagen->extension();
                $imageName = hash('sha1', $this->imagen);
                $imgComplete = $imageName . '.' . $extension;
                $imgCompleteWithRute = 'storage/images/banners/' . $imgComplete;
                $this->imagen->storeAs('images/banners/', $imgComplete, 'public');
    
                $banner = new Banner;
                $banner->titulo = $this->titulo;
                $banner->sub_titulo = $this->sub_titulo;
                $banner->descripcion = $this->descripcion;
                $banner->imagen = $imgCompleteWithRute;
                $banner->save();
    
                session(['alert' => ['type' => 'success', 'message' => 'Banner Guardado con éxito.', 'position' => 'center']]);
                return redirect()->to('/administracion/banners');
                $this->dispatchBrowserEvent('closeModal');
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal');
                $this->alert('error', $th->getMessage(), [
                    'position' => 'center',
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'OK',
                    'timer' => 50000,
                    'toast' => true,
                ]);
            }
                       
    }

    public function updateData()
    {
        if ($this->imagen != null) {
            $this->rules = [

                'imagen' => ['image', 'mimes:jpeg,png,jpg,gif,svg,webp'],
                'titulo' => 'required',
                'descripcion' => 'required'

            ];
        } else {
            $this->rules = [

                
                'titulo' => 'required',
                'descripcion' => 'required'

            ];
        }
        $this->validate();

        if ($this->imagen === null) {

            try {
                DB::table('banners')->where('id', $this->id_banner)->update([
                    'titulo' => $this->titulo,
                    'sub_titulo' => $this->sub_titulo,
                    'descripcion' => $this->descripcion,               
                ]);
    
                session(['alert' => ['type' => 'success', 'message' => 'Banner Actualizado con éxito.', 'position' => 'center']]);
                return redirect()->to('/administracion/banners');
                $this->dispatchBrowserEvent('closeModal');
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal');
                $this->alert('error', $th->getMessage(), [
                    'position' => 'center',
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'OK',
                    'timer' => 50000,
                    'toast' => true,
                ]);
            }           
        } else {
                                               
            try {

                if ($this->imagen <> null) {
                    if (file_exists($this->old_img)) {
                        File::delete($this->old_img);
                        }
                }
               

                $extension = $this->imagen->extension();
                $imageName = hash('sha1', $this->imagen);
                $imgComplete = $imageName . '.' . $extension;
                $imgCompleteWithRute = 'storage/images/banners/' . $imgComplete;
                $this->imagen->storeAs('images/banners/', $imgComplete, 'public');

                DB::table('banners')->where('id', $this->id_banner)->update([
                    'titulo' => $this->titulo,
                    'sub_titulo' => $this->sub_titulo,
                    'descripcion' => $this->descripcion,  
                    'imagen' =>  $imgCompleteWithRute,
                ]);

                
                session(['alert' => ['type' => 'success', 'message' => 'Banner Actualizado con éxito.', 'position' => 'center']]);
                return redirect()->to('/administracion/bannes');
                $this->dispatchBrowserEvent('closeModal');

            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal');
                $this->alert('error', $th->getMessage(), [
                    'position' => 'center',
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'OK',
                    'timer' => 50000,
                    'toast' => true,
                ]);
            }

        }
    }







    public function dropBanner($id)
    {
        Banner::where('id',$id)->delete();
        session(['alert' => ['type' => 'success', 'message' => 'Banner Eliminado con éxito.', 'position' => 'center']]);
        return redirect()->to('/administracion/banners');
        $this->dispatchBrowserEvent('closeModal');
    }


    public function render()
    {
        return view('livewire.backend.banner-component');
    }
}
