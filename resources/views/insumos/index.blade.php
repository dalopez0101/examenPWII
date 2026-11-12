@extends('layouts.app')

@section('title', 'Insumos')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="mb-1">Gestión de insumos</h4>
            <p class="text-muted mb-0">Administrar el inventario de la empresa.</p>
        </div>

        <a href="{{ route('insumos.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>
            Registrar insumo
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Búsqueda y filtros -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('insumos.index') }}" method="GET">
                <div class="row g-3 align-items-end">

                    <div class="col-md-6">
                        <label for="buscar" class="form-label">Buscar insumo</label>
                        <input
                            type="text"
                            name="buscar"
                            id="buscar"
                            class="form-control"
                            placeholder="Código, nombre o fabricante..."
                            value="{{ request('buscar') }}"
                        >
                    </div>

                    <div class="col-md-4">
                        <label for="categoria" class="form-label">Categoría</label>
                        <select name="categoria" id="categoria" class="form-select">
                            <option value="">Todas las categorías</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria }}"
                                    {{ request('categoria') == $categoria ? 'selected' : '' }}>
                                    {{ ucfirst($categoria) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-search"></i> Buscar
                        </button>

                        <a href="{{ route('insumos.index') }}" class="btn btn-outline-secondary"
                           title="Limpiar filtros">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Listado de insumos</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Imagen</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Fabricante</th>
                            <th>Precio</th>
                            <th>Inventario</th>
                            <th>Vencimiento</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($insumos as $insumo)
                            <tr>
                                <td>
                                    @if($insumo->imagen)
                                        <img
                                            src="{{ asset('storage/' . $insumo->imagen) }}"
                                            alt="{{ $insumo->nombre }}"
                                            width="50"
                                            height="50"
                                            class="rounded object-fit-cover"
                                        >
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                             style="width:50px;height:50px">
                                            <i class="bi bi-image text-muted fs-4"></i>
                                        </div>
                                    @endif
                                </td>

                                <td>{{ $insumo->codigo }}</td>
                                <td>{{ $insumo->nombre }}</td>
                                <td>{{ ucfirst($insumo->categoria) }}</td>
                                <td>{{ $insumo->fabricante ?: 'No especificado' }}</td>
                                <td>L {{ number_format((float)$insumo->precio, 2) }}</td>

                                <td>
                                    @if ($insumo->inventario > 20)
                                        <span class="badge bg-success">
                                            {{ $insumo->inventario }} - Óptimo
                                        </span>
                                    @elseif ($insumo->inventario >= 10)
                                        <span class="badge bg-warning text-dark">
                                            {{ $insumo->inventario }} - Moderado
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            {{ $insumo->inventario }} - ¡Desabastecimiento!
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{ $insumo->fecha_vencimiento
                                        ? $insumo->fecha_vencimiento->format('d/m/Y')
                                        : 'No aplica' }}
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('insumos.show', $insumo) }}"
                                           class="btn btn-sm btn-outline-info"
                                           title="Ver detalles">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ route('insumos.edit', $insumo) }}"
                                           class="btn btn-sm btn-outline-primary"
                                           title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{ route('insumos.destroy', $insumo) }}"
                                              method="POST"
                                              onsubmit="return confirm('¿Estás seguro de eliminar este insumo?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    No se encontraron insumos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">
                <small class="text-muted">
                    Mostrando {{ $insumos->firstItem() ?? 0 }}
                    a {{ $insumos->lastItem() ?? 0 }}
                    de {{ $insumos->total() }} registros
                </small>

                {{ $insumos->links() }}
            </div>
        </div>
    </div>

</div>
@endsection
