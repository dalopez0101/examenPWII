    <!-- START: Dashboard Header Banner -->
    <div class="page-header">
      <div>
        <h1 class="page-title">AGROVALLE HONDURAS</h1>
        <p class="page-subtitle">resumen corporativo: Distribuidora Agropecuaria del Valle S. de R.L.</p>
      </div>
    </div>
    <!-- END: Dashboard Header Banner -->

    <!-- START: Main Layout Grid (2 Columns: Dashboard + Performance Pane) -->
    <div class="row g-4">
      <!-- LEFT AREA: Primary Dashboard Stats & Tables -->
      <div class="col-xl-9 col-lg-8">

        <!-- START: Details Area (Transactions + Performance Charts) -->
      <div class="container-fluid">

          <div class="row g-4 mb-4">

              <!-- insumos -->
              <div class="col-xl-3 col-md-6">
                  <div class="card border-0 shadow-sm h-100">
                      <div class="card-body d-flex justify-content-between align-items-center">
                          <div>
                              <p class="text-muted mb-2">Insumos del catálogo</p>
                              <h3 class="fw-bold mb-1">
                                  {{ number_format($totalInsumos) }}
                              </h3>
                              <small class="text-muted">Insumos registrados</small>
                          </div>
                          <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                              <i class="bi bi-box-seam text-primary fs-3"></i>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- proveedores -->
              <div class="col-xl-3 col-md-6">
                  <div class="card border-0 shadow-sm h-100">
                      <div class="card-body d-flex justify-content-between align-items-center">
                          <div>
                              <p class="text-muted mb-2">Proveedores activos</p>
                              <h3 class="fw-bold mb-1">
                                  {{ number_format($totalProveedores) }}
                              </h3>
                              <small class="text-muted">Proveedores disponibles</small>
                          </div>
                          <div class="rounded-circle bg-success bg-opacity-10 p-3">
                              <i class="bi bi-truck text-success fs-3"></i>
                          </div>
                      </div>
                  </div>
              </div>

                    
              <!-- tarjeta Empleados -->
              <div class="col-xl-3 col-md-6">
                  <div class="card border-0 shadow-sm h-100">
                      <div class="card-body d-flex justify-content-between align-items-center">
                          <div>
                              <p class="text-muted mb-2">Empleados en nómina</p>
                              <h3 class="fw-bold mb-1">
                                  {{ number_format($totalEmpleados) }}
                              </h3>
                              <small class="text-muted">Personal activo</small>
                          </div>
                          <div class="rounded-circle bg-info bg-opacity-10 p-3">
                              <i class="bi bi-people text-info fs-3"></i>
                          </div>
                      </div>
                  </div>
              </div>

            <!-- area de inventarios -->
              <div class="col-xl-3 col-md-6">
                  <div class="card border-0 shadow-sm h-100">
                      <div class="card-body d-flex justify-content-between align-items-center">
                          <div>
                              <p class="text-muted mb-2">Valor del inventario</p>
                              <h3 class="fw-bold mb-1">
                                  L. {{ number_format($valorInventario, 2) }}
                              </h3>
                              <small class="text-muted">Valorización en lempiras</small>
                          </div>
                          <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                              <i class="bi bi-currency-exchange text-warning fs-3"></i>
                          </div>
                      </div>
                  </div>
              </div>

          </div>


      </div>
        <!-- END: Details Area -->

      </div>

      <!-- END: RIGHT AREA -->

    </div>
    <!-- END: Main Layout Grid -->

