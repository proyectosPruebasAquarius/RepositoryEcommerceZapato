var URLactual = window.location.pathname;
console.log(URLactual);

const Inicio = document.getElementById('inicio');
const Categorias = document.getElementById('categorias');
const SubCategorias = document.getElementById('subcategorias');
const Marcas = document.getElementById('marcas');
const Colores = document.getElementById('colores');
const Estilos = document.getElementById('estilos');
const Tallas = document.getElementById('tallas');
const Ofertas = document.getElementById('ofertas');
const Proveedores = document.getElementById('proveedores');
const Metodos = document.getElementById('metodos');
const Productos = document.getElementById('productos');
const Inventarios = document.getElementById('inventarios');
const Ventas = document.getElementById('ventas');
const Pedidos = document.getElementById('pedidos');
const Banners = document.getElementById('banners');
switch (URLactual) {
    case '/administracion':
        Inicio.classList.add('active')
        break;
    case '/administracion/categorias':
        Categorias.classList.add('active')
        break;
    case '/administracion/sub-categorias':
        SubCategorias.classList.add('active')
        break;
    case '/administracion/marcas':
        Marcas.classList.add('active')
        break;

    case '/administracion/colores':
        Colores.classList.add('active')
        break;

    case '/administracion/estilos':
        Estilos.classList.add('active')
        break;
    case '/administracion/tallas':
        Tallas.classList.add('active')
        break;

    case '/administracion/ofertas':
        Ofertas.classList.add('active')
        break;

    case '/administracion/proveedores':
        Proveedores.classList.add('active')
        break;

    case '/administracion/metodos-pagos':
        Metodos.classList.add('active')
        break;
    case '/administracion/productos':
        Productos.classList.add('active')
        break;

    case '/administracion/inventarios':
        Inventarios.classList.add('active')
        break;
    case '/administracion/ventas':
        Ventas.classList.add('active')
        break;
    case '/administracion/pedidos':
        Pedidos.classList.add('active')
        break;
    case '/administracion/banners':
        Banners.classList.add('active')
        break;
}