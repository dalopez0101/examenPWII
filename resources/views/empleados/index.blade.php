@extends('layouts.app')

@section('title', 'Personal y nómina')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="mb-1">Recursos humanos</h4>
            <p class="text-muted mb-0">
                Administración de personal técnico y colaboradores.
            </p>
        </div>

        <a href="{{ route('empleados.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus me-1"></i>
            Nuevo empleado
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <p class="mb-1">No se pudo completar la operación:</p>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('empleados.index') }}" method="GET">
                <div class="row g-2">

                    <div class="col-md-5">
                        <input
                            type="search"
                            name="buscar"
                            class="form-control"
                            placeholder="Buscar por identidad, nombre o correo..."
                            value="{{ request('buscar') }}"
                        >
                    </div>

                    <div class="col-md-3">
                        <select name="cargo" class="form-select">
                            <option value="">Todos los cargos</option>

                            @foreach ($cargos as $cargo)
                                <option value="{{ $cargo }}"
                                    @selected(request('cargo') === $cargo)>
                                    {{ ucfirst($cargo) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="estado" class="form-select">
                            <option value="">Todos los estados</option>
                            <option value="activo"
                                @selected(request('estado') === 'activo')>
                                Activos
                            </option>
                            <option value="inactivo"
                                @selected(request('estado') === 'inactivo')>
                                Inactivos
                            </option>
                        </select>
                    </div>

                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-fill">
                            <i class="bi bi-search"></i>
                        </button>

                        <a href="{{ route('empleados.index') }}"
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
                Personal registrado
                <span class="text-muted">({{ $empleados->total() }})</span>
            </h6>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Colaborador</th>
                            <th>Identidad</th>
                            <th>Correo</th>
                            <th>Cargo</th>
                            <th>Salario mensual</th>
                            <th>Ingreso</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($empleados as $empleado)
                            @php
                                $coloresCargo = [
                                    'ingeniero agronomo' => 'success',
                                    'asesor tecnico de campo' => 'info',
                                    'jefe de bodega central' => 'primary',
                                    'operador de maquinaria' => 'warning',
                                    'cajero' => 'secondary',
                                ];

                                $colorCargo = $coloresCargo[$empleado->cargo] ?? 'secondary';
                            @endphp

                            <tr>
                                <td>
                                    <div class="fw-semibold">
                                        {{ $empleado->nombre }} {{ $empleado->apellido }}
                                    </div>
                                </td>

                                <td>{{ $empleado->identidad }}</td>

                                <td>{{ $empleado->correo }}</td>

                                <td>
                                    <span class="badge bg-{{ $colorCargo }}-subtle text-{{ $colorCargo }}">
                                        {{ ucfirst($empleado->cargo) }}
                                    </span>
                                </td>

                                <td class="fw-semibold">
                                    L. {{ number_format((float) $empleado->salario, 2, '.', ',') }}
                                </td>

                                <td>
                                    {{ $empleado->fecha_ingreso->format('d/m/Y') }}
                                </td>

                                <td>
                                    @if ($empleado->estado === 'activo')
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-secondary">Inactivo</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center gap-1">

                                        <a href="{{ route('empleados.show', $empleado) }}"
                                           class="btn btn-sm btn-light"
                                           title="Ver detalles">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ route('empleados.edit', $empleado) }}"
                                           class="btn btn-sm btn-light"
                                           title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form
                                            action="{{ route('empleados.destroy', $empleado) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Deseas eliminar a este empleado? Esta acción no se puede deshacer.')"
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
                                    <i class="bi bi-people fs-2 text-muted"></i>
                                    <p class="text-muted mt-2 mb-0">
                                        No hay empleados registrados.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>

        <div class="card-footer bg-white">
            {{ $empleados->links() }}
        </div>
    </div>

</div>
@endsection