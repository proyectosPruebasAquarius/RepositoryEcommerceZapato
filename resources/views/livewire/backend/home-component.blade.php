<div>
  <div class="row justify-content-center">
    <div class="col-12">
      <div class="row align-items-center mb-2">
        <div class="col">
          <h2 class="h5 page-title">Bienvenido!</h2>
        </div>

      </div>
      <div class="mb-2 align-items-center">
        <div class="card shadow mb-4">
          <div class="card-body">
            <h1 class="mb-3 tex-center">Ventas</h1>
            <div class="row mt-1 align-items-center">
              <div class="col-12 col-lg-4 text-center pl-4">
                <p class="mb-1 small ">Diaria</p>


                @foreach ($DailySales as $daily)
                @if ($daily->cuentaTotal == null)
                <span class="h3">No hay datos registrados</span>
                @else
                <span class="h3">${{ $daily->cuentaTotal }}</span>

                @endif
                @endforeach
                <br>
                <span class="small ">Dia: {{ $today }}</span>
                <!-- <span class="fe fe-arrow-up text-success fe-12"></span>-->

              </div>
              <div class="col-12 col-lg-4 text-center py-4">
                <p class="mb-1 small ">Mensual</p>
                @foreach ($MonthSales as $m)
                @if ($m->cuentaTotal == null)
                <span class="h3">No hay datos registrados</span>
                @else
                <span class="h3">${{ $m->cuentaTotal }}</span>

                @endif
                @endforeach
                <br>
                <span class="small">Mes: {{ $month }}</span>
                <!--   <span class="fe fe-arrow-up text-success fe-12"></span>-->
              </div>
              <div class="col-12 col-lg-4 text-center py-4 mb-2">
                <p class="mb-1 small">Anual</p>
                @foreach ($YearSales as $y)
                @if ($y->cuentaTotal == null)
                <span class="h3">No hay datos registrados</span>
                @else
                <span class="h3">${{ $y->cuentaTotal }}</span>

                @endif
                @endforeach
                <br />
                <span class="small">Año: {{ $year }}</span>
                <!-- <span class="fe fe-arrow-up text-success fe-12"></span>-->
              </div>


            </div>
            <div class="chartbox mr-4">

            </div>
          </div> <!-- .card-body -->
        </div> <!-- .card -->
      </div>
      <div class="row items-align-baseline">

        <div class="col-md-12 col-lg-3">
          <div class="card shadow eq-card mb-4">
            <div class="card-body mb-n3">
              <div class="row items-align-baseline h-100">
                <div class="col-md-6 my-3">
                  <p class="mb-0">
                    <strong class="mb-0 text-uppercase">Producto mas Vendido</strong>
                  </p>
                  <br>
                  <h3>
                    @forelse ($bestSellingProduct as $sp)
                    {{ $sp->producto }}
                    @empty
                    No hay Datos Registrados
                    @endforelse</h3>
                  <!--<p class="text-muted">Este es un recuento del producto con mas ventas</p>-->
                </div>
                <div class="col-md-6 my-4 text-center">
                  <div lass="chart-box mx-4 ">
                    <div class="mt-5">
                      <i class="fe fe-box fe-50 "></i>
                    </div>
                  </div>
                </div>
                <!--  <div class="col-md-6 border-top py-3">
                      <p class="mb-1"><strong class="text-muted">Cost</strong></p>
                      <h4 class="mb-0">108</h4>
                      <p class="small text-muted mb-0"><span>37.7% Last week</span></p>
                    </div>
                    <div class="col-md-6 border-top py-3">
                      <p class="mb-1"><strong class="text-muted">Revenue</strong></p>
                      <h4 class="mb-0">1168</h4>
                      <p class="small text-muted mb-0"><span>-18.9% Last week</span></p>
                    </div> -->
              </div>
            </div> <!-- .card-body -->
          </div> <!-- .card -->
        </div> <!-- .col -->

        <div class="col-md-12 col-lg-3">
          <div class="card shadow eq-card mb-4">
            <div class="card-body mb-n3">
              <div class="row items-align-baseline h-100">
                <div class="col-md-6 my-3">
                  <p class="mb-0"><strong class="mb-0 text-uppercase">Cliente con mas Compras</strong></p>
                  <br>
                  <h3>
                    @forelse ($MaxBuyerCostumer as $mb)
                    {{ $mb->nombre }}
                    @empty
                    No hay Datos Registrados
                    @endforelse
                  </h3>

                </div>
                <div class="col-md-6 my-4 text-center">
                  <div lass="chart-box mx-4">
                    <div class="mt-5">
                      <i class="fe fe-user fe-50 "></i>
                    </div>
                  </div>
                </div>

              </div>
            </div> <!-- .card-body -->
          </div> <!-- .card -->
        </div> <!-- .col -->



        <div class="col-md-12 col-lg-3">
          <div class="card shadow eq-card mb-4">
            <div class="card-body mb-n3">
              <div class="row items-align-baseline h-100">
                <div class="col-md-6 my-3">
                  <p class="mb-0"><strong class="mb-0 text-uppercase ">Categoria mas Vendida</strong></p>
                  <br>
                  <h3>
                    @forelse ($bestSellingCategory as $mc)
                    {{ $mc->categoria }}
                    @empty
                    No hay Datos Registrados
                    @endforelse
                  </h3>

                </div>
                <div class="col-md-6 my-4 text-center">
                  <div lass="chart-box mx-4">
                    <div class="mt-5">
                      <i class="fe fe-grid fe-50 "></i>
                    </div>
                  </div>
                </div>

              </div>
            </div> <!-- .card-body -->
          </div> <!-- .card -->
        </div> <!-- .col -->

        <div class="col-md-12 col-lg-3">
          <div class="card shadow eq-card mb-4">
            <div class="card-body mb-n3">
              <div class="row items-align-baseline h-100">
                <div class="col-md-6 my-3">
                  <p class="mb-0"><strong class="mb-0 text-uppercase">Sub Categoria mas vendida</strong></p>
                  <br>
                  <h3>
                    @forelse ($bestSellingSubCategory as $msc)
                    {{ $msc->subcategoria }}
                    @empty
                    No hay Datos Registrados
                    @endforelse
                  </h3>

                </div>
                <div class="col-md-6 my-4 text-center">
                  <div lass="chart-box mx-4">
                    <div class="mt-5">
                      <i class="fe fe-command fe-50 "></i>
                    </div>
                  </div>
                </div>

              </div>
            </div> <!-- .card-body -->
          </div> <!-- .card -->
        </div> <!-- .col -->
      </div> <!-- .row -->



      <div class="row">
        <!-- Recent Activity -->
        <div class="col-md-12 col-lg-4 mb-4 ">
          <div class="card timeline shadow">
            <div class="card-header">
              <strong class="card-title">Sub Categorias mas Vendidas</strong>
              
            </div>
            <div class="card-body" data-simplebar style="height:355px; overflow-y: auto; overflow-x: hidden;">
              
              <table class="table table-borderless">

                <tbody class="text-center   me-5">
                    @forelse ($bestSellingSubCategory as $c)
                    <tr>
                      <ul class="list-group list-group-flush text-center">
                        <li class="list-group-item">{{ $c->subcategoria }}</li>
                        
                      </ul>
                        

                    </tr>
                    @empty
                    <tr>
                        <th>
                            <h1 class="text-center ">No hay Ventas Registradas</h1>
                        </th>
                        
                    </tr>
                    @endforelse
                </tbody>
            </table>
            </div> <!-- / .card-body -->
          </div> <!-- / .card -->
        </div> <!-- / .col-md-6 -->



        <!-- Striped rows -->
        <div class="col-md-12 col-lg-8 mt-1">
          <div class="card shadow">
            <div class="card-header">
              <strong class="card-title">Productos mas Vendidos</strong>
              
            </div>
            <div class="card-body"  style="height:355px;">
              <table class="table table-striped table-hover table-borderless">
                <thead>
                  <tr class=" bg-primary">
                    <th class="text-center">Imagen</th>
                    <th class="text-start">Producto</th>
                    <th class="text-start">Compras</th>
                    
                  </tr>
                </thead>
                <tbody >
                  <div data-simplebar style="overflow-y: auto; overflow-x: hidden;">
                    @forelse ($bestSellingProducts as $p)
                    <tr>
                        <th class="h-25 w-25 text-center">
                            <img src="{{ asset('storage/'.json_decode($p->imagen)[0]) }}" class="h-25 w-25">
                        </th>
                        <th class="text-start" >{{ $p->producto }}</th>
                        <th class="text-start">{{ $p->cuentaTotal }}</th>
                    </tr>
                    @empty
                    <tr>
                        <th>
                            <h1 class="text-center ">No hay Ventas Registradas</h1>
                        </th>
                        
                    </tr>
                    
                    @endforelse
                  </div>
                 
                  
                </tbody>
              </table>
            </div>
          </div>
        </div> <!-- Striped rows -->
      </div> <!-- .row-->


      <div class="row">
        <div class="col-md-12 col-lg-6 mt-1">
          <div class="card shadow">
            <div class="card-header">
              <strong class="card-title">Usuarios con más compras</strong>
              
            </div>
            <div class="card-body" data-simplebar style="height:355px; overflow-y: auto; overflow-x: hidden;">
              <table class="table table-striped table-hover table-borderless">
                <thead>
                  <tr class="bg-primary">
                    <th class="text-start">Nombre</th>
                    <th class="text-start">Correo</th>
                    <th class="text-center">Total de Compras </th>
                    <th class="text-start">Cantidad</th>
                    
                  </tr>
                </thead>
                <tbody class="text-center">
                  @forelse ($MaxBuyerCostumers as $cs)
                  <tr>

                      <th class="text-start">{{ $cs->nombre }}</th>
                      <th class="text-start">{{ $cs->correo }}</th>
                      <th class="text-center">{{ $cs->cuentaCompras }}</th>
                      <th class="text-start">${{ $cs->sumtotal }}</th>
                  </tr>
                  @empty
                  <tr>
                      <th>
                          <h1 class="text-center ">No hay Ventas Registradas</h1>
                      </th>
                      
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div> <!-- Striped rows -->

        <div class="col-md-12 col-lg-6 mt-1">
          <div class="card shadow">
            <div class="card-header">
              <strong class="card-title">Usuarios con menos compras</strong>
              
            </div>
            <div class="card-body" data-simplebar style="height:355px; overflow-y: auto; overflow-x: hidden;">
              <table class="table table-striped table-hover table-borderless">
                <thead>
                  <tr class="bg-primary">
                    <th class="text-start">Nombre</th>
                    <th class="text-start">Correo</th>
                    <th class="text-center">Total de Compras </th>
                    <th class="text-start">Cantidad</th>
                    
                  </tr>
                </thead>
                <tbody >
                  @forelse ($MinBuyerCostumers as $cs)
                  <tr>

                      <th class="text-start">{{ $cs->nombre }}</th>
                      <th class="text-start">{{ $cs->correo }}</th>
                      <th class="text-center">{{ $cs->cuentaCompras }}</th>
                      <th class="text-start">${{ $cs->sumtotal }}</th>
                  </tr>
                  @empty
                  <tr>
                      <th>
                          <h1 class="text-center ">No hay Ventas Registradas</h1>
                      </th>
                      
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div> <!-- Striped rows -->
      </div>




    </div> <!-- .col-12 -->
  </div> <!-- .row -->
</div>