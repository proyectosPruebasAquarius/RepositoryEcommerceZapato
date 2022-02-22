<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
      <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
      <!-- nav bar -->
      <div class="w-100 mb-4 d-flex">
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ url('/administracion') }}">
          <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
            <g>
              <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
              <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
              <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
            </g>
          </svg>
        </a>
      </div>
      
      <ul class="navbar-nav flex-fill w-100 mb-2">
        <li class="nav-item w-100 " id="inicio">
          <a class="nav-link" href="{{ url('administracion/') }}">
            <i class="fe fe-home fe-16"></i>
            <span class="ml-3 item-text">Inicio</span>
          </a>
        </li>
        <li class="nav-item w-100 " id="banners">
          <a class="nav-link" href="{{ url('administracion/banners') }}">
            <i class="fe fe-image fe-16"></i>
            <span class="ml-3 item-text">Banners</span>
          </a>
        </li>
        <li class="nav-item w-100 " id="materiales">
          <a class="nav-link" href="{{ url('administracion/materiales') }}">
            <i class="fe fe-archive fe-16"></i>
            <span class="ml-3 item-text">Materiales</span>
          </a>
        </li>
        <li class="nav-item w-100 " id="categorias">
          <a class="nav-link" href="{{ url('administracion/categorias') }}">
            <i class="fe fe-grid fe-16"></i>
            <span class="ml-3 item-text">Categorias</span>
          </a>
        </li>
        <li class="nav-item w-100 " id="subcategorias">
          <a class="nav-link" href="{{ url('administracion/sub-categorias') }}">
            <i class="fe fe-command fe-16"></i>
            <span class="ml-3 item-text">Sub Categorias</span>
          </a>
        </li>
        <li class="nav-item w-100 " id="marcas">
          <a class="nav-link" href="{{ url('administracion/marcas') }}">
            <i class="fe fe-package fe-16"></i>
            <span class="ml-3 item-text">Marcas</span>
          </a>
        </li>

        <li class="nav-item w-100 " id="colores">
          <a class="nav-link" href="{{ url('administracion/colores') }}">
            <i class="fe fe-slack fe-16"></i>
            <span class="ml-3 item-text">Colores</span>
          </a>
        </li>
        <li class="nav-item w-100 " id="estilos">
          <a class="nav-link" href="{{ url('administracion/estilos') }}">
            <i class="fe fe-sliders fe-16"></i>
            <span class="ml-3 item-text">Estilos</span>
          </a>
        </li>
        <li class="nav-item w-100 " id="tallas">
          <a class="nav-link" href="{{ url('administracion/tallas') }}">
            <i class="fe fe-crosshair fe-16"></i>
            <span class="ml-3 item-text">Tallas</span>
          </a>
        </li>
        <li class="nav-item w-100 " id="ofertas">
          <a class="nav-link" href="{{ url('administracion/ofertas') }}">
            <i class="fe fe-gift fe-16"></i>
            <span class="ml-3 item-text">Ofertas</span>
          </a>
        </li>
        <li class="nav-item w-100 " id="proveedores">
          <a class="nav-link" href="{{ url('administracion/proveedores') }}">
            <i class="fe fe-box fe-16"></i>
            <span class="ml-3 item-text">Proveedores</span>
          </a>
        </li>

        <li class="nav-item w-100 " id="metodos">
          <a class="nav-link" href="{{ url('administracion/metodos-pagos') }}">
            <i class="fe fe-credit-card fe-16"></i>
            <span class="ml-3 item-text">Metos de Pagos</span>
          </a>
        </li>
        <li class="nav-item w-100 " id="productos">
          <a class="nav-link" href="{{ url('administracion/productos') }}">
            <i class="fe fe-shopping-bag fe-16"></i>
            <span class="ml-3 item-text">Productos</span>
          </a>
        </li>

        <li class="nav-item w-100 " id="inventarios">
          <a class="nav-link" href="{{ url('administracion/inventarios') }}">
            <i class="fe fe-book fe-16"></i>
            <span class="ml-3 item-text">Inventarios</span>
          </a>
        </li>

        <li class="nav-item w-100 " id="ventas">
          <a class="nav-link" href="{{ url('administracion/ventas') }}">
            <i class="fe fe-dollar-sign fe-16"></i>
            <span class="ml-3 item-text">Ventas</span>
          </a>
        </li>
        <li class="nav-item w-100 " id="pedidos">
          <a class="nav-link" href="{{ url('administracion/pedidos') }}">
            <i class="fe fe-truck fe-16"></i>
            <span class="ml-3 item-text">Pedidos</span>
          </a>
        </li>
       
      </ul>
     
    </nav>
  </aside>