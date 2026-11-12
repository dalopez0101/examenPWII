<div class="sidebar-wrapper" id="sidebar">

    <!-- Identidad de la tienda -->
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
        <i class="bi bi-asterisk"></i>
        <span>AGROVALLE HONDURAS</span>
    </a>

    <div class="flex-grow-1 overflow-y-auto">

        <!-- Menú principal -->
        <div class="sidebar-menu-section">
            <div class="sidebar-menu-title">Menú</div>

            <ul class="sidebar-menu-list">
                <li class="sidebar-menu-item">
                    <a href="{{ route('dashboard') }}"
                       class="sidebar-menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                       title="Dashboard">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Módulos del sistema -->
        <div class="sidebar-menu-section">
            <div class="sidebar-menu-title">Sistema</div>

            <ul class="sidebar-menu-list">

                <li class="sidebar-menu-item">
                    <a href="{{ route('insumos.index') }}"
                       class="sidebar-menu-link {{ request()->routeIs('insumos.*') ? 'active' : '' }}"
                       title="Insumos">
                        <i class="bi bi-box-seam"></i>
                        <span>Insumos</span>
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a href="#" class="sidebar-menu-link" title="Proveedores">
                        <i class="bi bi-truck"></i>
                        <span>Proveedores</span>
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a href="#" class="sidebar-menu-link" title="Empleados">
                        <i class="bi bi-people"></i>
                        <span>Empleados</span>
                    </a>
                </li>

            </ul>
        </div>

        <!-- Cuenta -->
        <div class="sidebar-menu-section">
            <div class="sidebar-menu-title">Cuenta</div>

            <ul class="sidebar-menu-list">
                <li class="sidebar-menu-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="sidebar-menu-link w-100 border-0 bg-transparent text-start">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Cerrar sesión</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </div>

    <!-- Perfil del usuario -->
    <div class="sidebar-profile">
        <img src="{{ asset('assets/images/avatar.png') }}"
             alt="Usuario"
             class="sidebar-profile-img">

        <div class="sidebar-profile-info">
            <div class="sidebar-profile-name">
                {{ Auth::user()->name }}
            </div>

            <div class="sidebar-profile-email">
                {{ Auth::user()->email }}
            </div>
        </div>
    </div>

</div>
