<?php

namespace App\Http\Livewire\Backend;

use App\Models\Categoria;
use App\Models\Color;
use App\Models\DetalleColor;
use App\Models\DetalleProducto;
use App\Models\DetalleTalla;
use App\Models\Estilo;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\SubCategoria;
use App\Models\Talla;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductoComponent extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    public $id_producto,
    $nombre,
    $cod,
    $descripcion,
    $proveedor,
    $proveedores = [],
    $marca,
    $marcas = [],
    $imagen = [],
    $id_detalle_producto,
    $estilo,
    $estilos = [],
    $color = [],
    $colores = [],
    $tallas = [],
    $talla = [],
    $categorias = [],
    $categoria,
    $sub_categorias = [],
    $subcat,
    $oldImg,
    $estado,
    $oldEstado;

    protected $listeners = ['resetNamesProducto' => 'resetInput', 'asignProducto' => 'asignProducto', 'dropByStateProducto' => 'dropByState'];

    protected $rules = [
        'cod' => 'required|min:4|max:100',
        'descripcion' => 'required|min:10|max:1500',
        'marca' => 'required',
        'estilo' => 'required',
        

    ];
    protected $messages = [
        'nombre.required' => 'El Nombre es Obligatorio',
        'cod.required' => 'El Codigo es Obligatorio',
        'cod.min' => 'El Codigo debe contener un minimo de :min de caracteres',
        'cod.max' => 'El Codigo debe contener un maximo de :max de caracteres',
        'marca.required' => 'La Marca es Obligatoria',
        'estilo.required' => 'El estilo es Obligatorio',
        'subcat.required' => 'La sub Categoria es Obligatoria',
        'color.required' => 'El color es Obligatorio',
        'talla.required' => 'La Talla es Obligatoria',
        'categoria.required' => 'La Categoria es Obligatoria',

        'proveedor.required' => 'EL Proveedor es Obligatorio',
        'descripcion.required' => 'La descripcion es Obligatoria',
        'descripcion.min' => 'La descripcion debe contener un mínimo de :min caracteres',
        'descripcion.max' => 'La descripcion debe contener un máximo de :max caracteres',
        'nombre.min' => 'El Nombre debe contener un mínimo de :min caracteres',
        'nombre.max' => 'El Nombre debe contener un máximo de :max caracteres',
        'imagen.required' => 'La Imagen del producto es Obligatoria',
        'imagen.*.mimes' => 'Formato de Imagen no Valido',
        'imagen.*.image' => 'Debe ser una Imagen',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetInput()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset(['nombre', 'cod', 'estado', 'descripcion', 'marca', 'estilo', 'categoria', 'subcat', 'color', 'talla', 'imagen', 'id_producto', 'proveedor']);
    }

    public function asignProducto($producto)
    {
        $this->oldEstado= $producto['estado'];
        $this->id_producto = $producto['id_producto'];
        $this->nombre = $producto['nombre'];
        $this->estado = $producto['estado'];
        $this->marca = $producto['marca'];
        $this->proveedor = $producto['proveedor'];
        $this->oldImg = $producto['imagen'];
        $this->descripcion = $producto['descripcion'];
        $this->cod = $producto['cod'];
        $this->estilo = $producto['estilo'];
        $this->marcas = Marca::where('estado', 1)->select('nombre', 'id')->get();
        $this->proveedores = Proveedor::where('estado', 1)->select('nombre', 'id')->get();
    }

    public function updateData()
    {
        if ($this->oldImg != null) {
            $this->rules = [

                'cod' => 'required|min:4|max:100',
                'descripcion' => 'required|min:10|max:1500',
                'marca' => 'required',
                'estilo' => 'required',

            ];
        } else {

        }
        $this->validate();

        if (sizeof($this->imagen) === 0) {
            DB::table('productos')->where('id', $this->id_producto)->update([
                'nombre' => $this->nombre,
                'estado' => $this->estado,
                'descripcion' => $this->descripcion,
                'id_proveedor' => $this->proveedor,
                'id_marca' => $this->marca,
                'id_estilo' => $this->estilo,

            ]);

            session(['alert' => ['type' => 'success', 'message' => 'Producto Actualizado con éxito.', 'position' => 'center']]);
            return redirect()->to('/administracion/productos');
            $this->dispatchBrowserEvent('closeModal');

        } else {
            /* foreach(json_decode($this->oldImg) as $img) {
            $image_path = public_path("storage/images/metodos_pagos/".$img);
            if (file_exists($image_path)) {
            File::delete($image_path);
            }
            }*/

            try {

                $numItems = count($this->imagen);
                $i = 0;
                foreach ($this->imagen as $photo) {
                    $extension = $photo->extension();
                    $imageName = hash('sha1', $photo);
                    $imgComplete = $imageName . '.' . $extension;
                    $imgCompleteWithRute = 'images/productos/' . $imgComplete;
                    $photo->storeAs('images/productos/', $imgComplete, 'public');

                    $data[] = $imgCompleteWithRute;
                    if (++$i === $numItems) {
                        Producto::where('id', '=', $this->id_producto)->update([
                            'nombre' => $this->nombre,
                            'estado' => $this->estado,
                            'descripcion' => $this->descripcion,
                            'id_proveedor' => $this->proveedor,
                            'id_marca' => $this->marca,
                            'id_estilo' => $this->estilo,
                            'imagen' => json_encode($data),
                        ]);
                    }
                }
                session(['alert' => ['type' => 'success', 'message' => 'Producto Actualizado con éxito.', 'position' => 'center']]);
                return redirect()->to('/administracion/productos');
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

    public function createData()
    {
        if ($this->oldImg != null) {
            $this->rules = [

                'cod' => 'required|min:4|max:100',
                'descripcion' => 'required|min:10|max:1500',
                'marca' => 'required',
                'estilo' => 'required',
                
            ];
        } else {
            $this->rules = [
                'imagen' => ['required'],
                'imagen.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg,webp'],
                'nombre' => 'required|min:4|max:100',
                'cod' => 'required|min:4|max:100',
                'descripcion' => 'required|min:10|max:1500',
                'marca' => 'required',
                'estilo' => 'required',
                'categoria' => 'required',
                'subcat' => 'required',
                'color' => 'required',
                'talla' => 'required',
                'proveedor' => 'required'
            ];
        }
        $this->validate();
        /* session(['alert' => ['type' => 'success', 'message' => $this->id_producto, 'position' => 'center']]);
        return redirect()->to('/administracion/productos');
        $this->dispatchBrowserEvent('closeModal');*/
        try {
            DB::beginTransaction();
            $producto = new Producto;
            $producto->nombre = $this->nombre;
            $producto->cod = $this->cod;
            $producto->descripcion = $this->descripcion;
            $producto->id_proveedor = $this->proveedor;
            $producto->id_marca = $this->marca;
            $producto->id_estilo = $this->estilo;

            $detalleProducto = new DetalleProducto;
            $detalleProducto->id_categoria = $this->categoria;
            $detalleProducto->id_sub_categoria = $this->subcat;
            $detalleProducto->save();

            $producto->id_detalle_producto = $detalleProducto->id;
            $numItems = count($this->imagen);
            $i = 0;
            foreach ($this->imagen as $photo) {
                $extension = $photo->extension();
                $imageName = hash('sha1', $photo);
                $imgComplete = $imageName . '.' . $extension;
                $imgCompleteWithRute = 'images/productos/' . $imgComplete;
                $photo->storeAs('images/productos/', $imgComplete, 'public');

                $data[] = $imgCompleteWithRute;
                if (++$i === $numItems) {
                    $producto->imagen = json_encode($data);
                    $producto->save();

                }
            };

            $detalleColor = new DetalleColor;
            /*  $detalleColor->id_producto = $producto->id;*/
            foreach ($this->color as $c) {
                $detalleColor = new DetalleColor;
                $detalleColor->id_producto = $producto->id;
                $detalleColor->id_color = $c;
                $detalleColor->save();
            }

            $detalleTalla = new DetalleTalla;

            foreach ($this->talla as $t) {
                $detalleTalla = new DetalleTalla;
                $detalleTalla->id_producto = $producto->id;
                $detalleTalla->id_talla = $t;
                $detalleTalla->save();
            }
            DB::commit();

            session(['alert' => ['type' => 'success', 'message' => 'Producto Guardado con éxito.', 'position' => 'center']]);
            return redirect()->to('/administracion/productos');
            $this->dispatchBrowserEvent('closeModal');

        } catch (\Throwable $th) {
            DB::rollBack();
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

    public function dropByState($id)
    {
        try {
            Producto::where('id', $id)->update(['estado' => 0]);
            session(['alert' => ['type' => 'success', 'message' => 'Producto desactivado con éxito.']]);
            return redirect()->to('administracion/productos');
        } catch (\Exception $th) {

            $this->alert('error', 'Ocurrió un error porfavor intentelo mas tarde.', [
                'position' => 'center',
            ]);
        }
    }

    public function render()
    {
        $this->estilos = Estilo::where('estado', 1)->select('nombre', 'id')->get();
        $this->marcas = Marca::where('estado', 1)->select('nombre', 'id')->get();
        $this->colores = Color::where('estado', 1)->select('nombre', 'id')->get();
        $this->tallas = Talla::where('estado', 1)->select('nombre', 'id')->get();
        $this->categorias = Categoria::where('estado', 1)->select('nombre', 'id')->get();
        $this->sub_categorias = SubCategoria::where('estado', 1)->select('nombre', 'id')->get();
        $this->proveedores = Proveedor::where('estado', 1)->select('nombre', 'id')->get();
        
        return view('livewire.backend.producto-component');
    }

   






























    
}
