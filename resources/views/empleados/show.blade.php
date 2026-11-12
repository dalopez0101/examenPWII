@extends('layouts.app')

@section('title', 'Detalles del empleado')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4>Expediente del colaborador</h4>
            <p class="text-muted mb-0">
                {{ $empleado->nombre }} {{ $empleado->apellido }}
            </p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('empleados.edit', $empleado) }}"
               class="btn btn-primary">
                <i class="bi bi-pencil me-1"></i> Editar
            </a>

            <a href="{{ route('empleados.index') }}" class="btn btn-light">
                Volver
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h6 class="mb-0">Información personal y laboral</h6>
        </div>

        <div class="card-body p-4">
            <div class="row g-4">

                <div class="col-md-6">
                    <small class="text-muted">Nombre completo</small>
                    <h6>{{ $empleado->nombre }} {{ $empleado->apellido }}</h6>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Identidad</small>
                    <h6>{{ $empleado->identidad }}</h6>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Correo electrónico</small>
                    <h6>{{ $empleado->correo }}</h6>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Cargo</small>
                    <h6>{{ ucfirst($empleado->cargo) }}</h6>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Salario mensual</small>
                    <h6>
                        L. {{ number_format((float) $empleado->salario, 2, '.', ',') }}
                    </h6>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Fecha de ingreso</small>
                    <h6>{{ $empleado->fecha_ingreso->format('d/m/Y') }}</h6>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Estado</small>
                    <h6>
                        @if ($empleado->estado === 'activo')
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-secondary">Inactivo</span>
                        @endif
                    </h6>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Fecha de registro del sistema</small>
                    <h6>{{ $empleado->created_at->format('d/m/Y H:i') }}</h6>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection