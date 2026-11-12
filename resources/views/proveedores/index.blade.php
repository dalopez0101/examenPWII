@extends('layouts.app')

@section('title', 'Proveedores')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="mb-1">Fabricantes y proveedores</h4>
            <p class="text-muted mb-0">
                Administración de proveedores agrícolas.
            </p>
        </div>

        <a href="{{ route('proveedores.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>
            Nuevo proveedor
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form action="{{ route('proveedores.index') }}" method="GET">
                <div class="row g-2">

                    <div class="col-md-5">
                        <input
                            type="search"
                            name="buscar"
                            class="form-control"
                            placeholder="Buscar por RTN, empresa o contacto..."
                            value="{{ request('buscar') }}"
                        >
                    </div>

                    <div class="col-md-3">
                        <select name="categoria" class="form-select">
                            <option value="">Todas las categorías</option>

                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria }}"
                                    @selected(request('categoria') === $categoria)>
                                    {{ ucfirst($categoria) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="estado" class="form-select">
                            <option value="">Todos los estados</option>
                            <option value="activo" @selected(request('estado') === 'activo')>
                                Activos
                            </option>
                            <option value="inactivo" @selected(request('estado') === 'inactivo')>
                                Inactivos
                            </option>
                        </select>
                    </div>

                    <div class="col-md-2 d-flex gap-2">
                        <button class="btn btn-primary flex-fill" type="submit">
                            <i class="bi bi-search"></i>
                        </button>

                        <a href="{{ route('proveedores.index') }}"
                           class="btn btn-light">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    </div>

                </div>
            </form>

        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h6 class="mb-0">
                Listado de proveedores
                <span class="text-muted">
                    ({{ $proveedores->total() }})
                </span>
            </h6>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Empresa</th>
                            <th>RTN</th>
                            <th>Contacto</th>
                            <th>Categoría</th>
                            <th>Límite de crédito</th>
                            <th>Plazo</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($proveedores as $proveedor)
                            <tr>
                                <td>
                                    <div class="fw-semibold">
                                        {{ $proveedor->empresa }}
                                    </div>
                                    <small class="text-muted">
                                        {{ $proveedor->telefono }}
                                    </small>
                                </td>

                                <td>{{ $proveedor->rtn }}</td>

                                <td>{{ $proveedor->contacto }}</td>

                                <td>
                                    <span class="badge bg-info-subtle text-info">
                                        {{ ucfirst($proveedor->categorias) }}
                                    </span>
                                </td>

                                <td>
                                    L {{ number_format($proveedor->limite_credito, 2) }}
                                </td>

                                <td>
                                    <span class="badge bg-primary-subtle text-primary">
                                        {{ $proveedor->dias_credito }} días
                                    </span>
                                </td>

                                <td>
                                    @if ($proveedor->estado === 'activo')
                                        <span class="badge bg-success">
                                            Activo
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            Inactivo
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">

                                        <a href="{{ route('proveedores.show', $proveedor) }}"
                                           class="btn btn-sm btn-light"
                                           title="Ver detalles">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ route('proveedores.edit', $proveedor) }}"
                                           class="btn btn-sm btn-light"
                                           title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form
                                            action="{{ route('proveedores.destroy', $proveedor) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Estás seguro de eliminar este proveedor?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-light text-danger"
                                                    title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <i class="bi bi-building fs-2 text-muted"></i>
                                    <p class="text-muted mt-2 mb-0">
                                        No se encontraron proveedores registrados.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>

        <div class="card-footer bg-white">
            {{ $proveedores->links() }}
        </div>
    </div>

</div>
@endsection