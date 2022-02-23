<?php

namespace App\Http\Livewire\Frontend;

use App\Models\DatoVenta;
use App\Models\Departamento;
use App\Models\DetalleVenta;
use App\Models\Direccion;
use App\Models\DireccionFacturaccion;
use App\Models\MetodoPago;
use App\Models\Municipio;
use App\Models\Venta;
use App\Models\User;
use App\Models\Inventario;
use App\Notifications\SaleInvoice;
use Livewire\Component;
use Livewire\WithFileUploads;

class Checkout extends Component
{
    use WithFileUploads;
    public $error;
    public $countCart = 1;
    public $tab = 'entrega';
    public $collapse = 'collapse-0';
    public $tabStore = 'direccion';
    // Direcciones
    public $direccion;
    public $referencia;
    public $id_municipio;
    public $departamento;
    public $municipios = array();
    // propiedad si se selecciona;
    public $id_direccion;

    // Direcciones de facturaciones
    public $direccionFacturaciones;
    public $referenciaFacturaciones;
    public $id_municipioFacturaciones;
    public $departamentoF;
    public $municipiosF = array();
    // propiedad si se selecciona;
    public $id_facturacion;

    public $recoger_tienda;

    public $id_metodo_pago;
    // Datos_ventas
    public $numero;
    public $imagen;
    // Datso usuario
    public $telefono;

    protected $rules = [
        //'direccion' => 'required_without_all:id_direccion,recoger_tienda,id_facturacion|string|min:4|max:500',
        'direccion' => 'required_without_all:id_direccion,recoger_tienda,id_facturacion',
        'referencia' => 'nullable|string|min:4|max:200',
        'departamento' => 'required_without_all:id_direccion,recoger_tienda,id_facturacion',
        'id_municipio' => 'required_without_all:id_direccion,recoger_tienda,id_facturacion',

        //'direccionFacturaciones' => 'required_without_all:id_facturacion,recoger_tienda,id_facturacion|string|min:4|max:500',
        'direccionFacturaciones' => 'required_without_all:id_facturacion,recoger_tienda,id_facturacion',
        'referenciaFacturaciones' => 'nullable|string|min:4|max:200',
        'departamentoF' => 'required_without_all:id_facturacion,recoger_tienda,id_facturacion',
        'id_municipioFacturaciones' => 'required_without_all:id_facturacion,recoger_tienda,id_facturacion',

        'id_direccion' => 'required_without_all:direccion,referencia,departamento,id_municipio,recoger_tienda',
        'id_facturacion' => 'required_without_all:direccionFacturaciones,referenciaFacturaciones,departamentoF,id_municipioFacturaciones,recoger_tienda',

        'recoger_tienda' => 'required_without_all:direccion,referencia,departamento,id_municipio,id_direccion,id_facturacion',

        'id_metodo_pago' => 'required',
        'numero' => 'required|string|min:7|max:20',
        'imagen' => 'required|image|max:5024|mimes:png,jpg,jpeg',

        'telefono' => 'required|string|min:8|max:12',
    ];

    public function updated($propertyName)
    {
        switch ($propertyName) {
            case 'direccion':
                $this->validateOnly($propertyName, [
                    'direccion' => 'string|min:4|max:500',
                ]);
                break;
            case 'direccionFacturaciones':
                $this->validateOnly($propertyName, [
                    'direccionFacturaciones' => 'string|min:4|max:500',
                ]);
                break;

            default:
                $this->validateOnly($propertyName);
                break;
        }
    }

    public function updatedRecogerTienda($value)
    {

        $this->reset(['id_direccion', 'id_facturacion', 'direccion', 'direccionFacturaciones', 'referencia', 'departamento', 'id_municipio', 'referenciaFacturaciones', 'departamentoF', 'id_municipioFacturaciones']);
    }

    public function updatedIdDireccion()
    {
        $this->reset('recoger_tienda');
    }

    public function updatedIdFacturacion()
    {
        $this->reset('recoger_tienda');
    }

    public function updatedDepartamento($value)
    {
        $this->municipios = Municipio::where('id_departamento', $value)->get();
    }

    public function updatedDepartamentoF($value)
    {
        $this->municipiosF = Municipio::where('id_departamento', $value)->get();
    }

    public function venta()
    {

        $contentCart = \Cart::getContent();
        $totalCart = \Cart::getTotal();
        $id_direccion;

        try {
            $validatedData = $this->validate();
            $validatedData['id_user'] = auth()->user()->id;

            \DB::beginTransaction();
            $id_direccion = null;
            $facturacion = null;
            if (empty($validatedData['recoger_tienda'])) {
                /* direccion de envio */
                if (empty($validatedData['id_direccion'])) {
                    $direccion = new Direccion;
                    $direccion->direccion = $validatedData['direccion'];
                    $direccion->id_user = $validatedData['id_user'];
                    $direccion->id_municipio = $validatedData['id_municipio'];
                    $direccion->referencia = $validatedData['referencia'];
                    $direccion->saveOrFail();
                    $id_direccion = $direccion->id;
                } else {
                    $id_direccion = $validatedData['id_direccion'];
                }

                /* direccion facturacion */
                if ($validatedData['id_facturacion']) {
                    $facturacion = $validatedData['id_facturacion'];
                } else {
                    $fct = new DireccionFacturaccion;
                    $fct->direccion = $validatedData['direccionFacturaciones'];
                    $fct->id_municipio = $validatedData['id_municipioFacturaciones'];
                    $fct->id_user = $validatedData['id_user'];
                    $fct->referencia = $validatedData['referenciaFacturaciones'];
                    $fct->saveOrFail();

                    $facturacion = $fct->id;
                }
            }
              /* user telefono */
              if ($validatedData['telefono'] != auth()->user()->telefono) {
                $telefono = User::findOrFail(auth()->user()->id);
                $telefono->telefono = $validatedData['telefono'];
                $telefono->saveOrFail();
            }
            

            /* venta */
            $venta = new Venta;
            $venta->id_usuario = $validatedData['id_user'];
            $venta->total = $totalCart;
            $venta->num_transaccion = sha1(time());
            $venta->id_direccion = $id_direccion;
            $venta->id_metodo_pago = $validatedData['id_metodo_pago'];
            $venta->estado = strtolower($this->getMetodoPago($validatedData['id_metodo_pago'])) == "chivo wallet" || strtolower($this->getMetodoPago($validatedData['id_metodo_pago'])) == "banco agricola" ? 0 : 1;
            $venta->id_facturacion = $facturacion;
            $venta->recoger_tienda = $validatedData['recoger_tienda'] ? $validatedData['recoger_tienda'] : 0; //$request->recoger_tienda;
            $venta->saveOrFail();

            foreach ($contentCart as $ct) {
                $detail = new DetalleVenta;
                $detail->id_producto = $ct['attributes']['id_producto'];
                $detail->id_venta = $venta->id;
                $detail->cantidad = $ct->quantity;
                $detail->id_color = $ct['attributes']['color'];
                $detail->id_talla = $ct['attributes']['size'];
                $detail->precio_venta = $ct->price;
                $oferta = null;
                $oferta = Inventario::join('ofertas', 'ofertas.id', '=', 'inventarios.id_oferta')->select('ofertas.nombre as ofertas')->where('inventarios.id', $ct['attributes']['id_inventario'])->first();

                if ($oferta <> null) {
                    $detail->oferta = $oferta->ofertas;
                } else {
                    $detail->oferta = $oferta;
                }
                $detail->save();

            }
            if (strtolower($this->getMetodoPago($validatedData['id_metodo_pago'])) == "chivo wallet" || strtolower($this->getMetodoPago($validatedData['id_metodo_pago'])) == "banco agricola") {

                //if ($request->hasfile('imagen')) {
                $datoVenta = new DatoVenta;
                $datoVenta->numero = $validatedData['numero'];
                $imageExt = time() . '.' . $validatedData['imagen']->extension();
                $imageName = $validatedData['imagen']->storeAs('photo', $imageExt, 'public');
                //$url = \Storage::url($imageName);

                $datoVenta->imagen = $imageExt;
                $datoVenta->id_venta = $venta->id;
                $datoVenta->save();
                //}

            }

            $admins = User::where('id_tipo_usuario', 1)->get();

            \Notification::send($admins, new SaleInvoice($venta));
            \Cart::clear();
            \DB::commit();
            return redirect()->to('/perfil'); //redirect('/profile')->with('correlative',$venta->num_transaccion);
        } catch (\Exception $e) {
            \DB::rollback();
            $this->error = $e->getMessage();

        }
    }

    public function getMetodoPago($id)
    {
        return MetodoPago::where('id', $id)->value('nombre');
    }

    public function storeTab($tab)
    {
        $this->tab = $tab;
    }

    public function mount()
    {
        /* if (\Cart::isEmpty()) {
        return redirect()->to('/productos');
        } */
        $metodoPagoFirst = MetodoPago::first();
        if ($metodoPagoFirst) {
            $this->id_metodo_pago = $metodoPagoFirst->id;
        }
        $this->telefono = !empty(auth()->user()->telefono) ? auth()->user()->telefono : NULL;
    }

    public function render()
    {
        $user = auth()->user()->id;
        $cart = \Cart::getContent()->toArray();
        $direcciones = Direccion::join('municipios', 'direcciones.id_municipio', '=', 'municipios.id')->join('departamentos', 'municipios.id_departamento', '=', 'departamentos.id')
            ->where('id_user', $user)->select('direcciones.*', 'municipios.nombre as municipio', 'departamentos.nombre as departamento', 'municipios.id_departamento')->get();
        $facturaciones = DireccionFacturaccion::join('municipios', 'direcciones_facturaciones.id_municipio', '=', 'municipios.id')->join('departamentos', 'municipios.id_departamento', '=', 'departamentos.id')
            ->where('id_user', $user)->select('direcciones_facturaciones.*', 'municipios.nombre as municipio', 'departamentos.nombre as departamento', 'municipios.id_departamento')->get();
        $metodosPagos = MetodoPago::get();
        $departamentos = Departamento::get();

        return view('livewire.frontend.checkout', [
            'cart' => $cart,
            'direcciones' => $direcciones,
            'facturaciones' => $facturaciones,
            'metodosPagos' => $metodosPagos,
            'departamentos' => $departamentos,
        ]);
    }
}
