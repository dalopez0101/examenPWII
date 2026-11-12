@extends('layouts.app')

@section('title', 'Detalles del proveedor')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4>Detalles del proveedor</h4>
            <p class="text-muted mb-0">{{ $proveedor->empresa }}</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('proveedores.edit', $proveedor) }}"
               class="btn btn-primary">
                <i class="bi bi-pencil me-1"></i> Editar
            </a>

            <a href="{{ route('proveedores.index') }}"
               class="btn btn-light">
                Volver
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">

            <div class="row g-4">

                <div class="col-md-6">
                    <small class="text-muted">Razón social</small>
                    <h6>{{ $proveedor->empresa }}</h6>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">RTN</small>
                    <h6>{{ $proveedor->rtn }}</h6>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Asesor comercial</small>
                    <h6>{{ $proveedor->contacto }}</h6>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Teléfono</small>
                    <h6>{{ $proveedor->telefono }}</h6>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Categoría</small>
                    <h6>{{ ucfirst($proveedor->categorias) }}</h6>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Límite de crédito</small>
                    <h6>L {{ number_format($proveedor->limite_credito, 2) }}</h6>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Plazo de crédito</small>
                    <h6>{{ $proveedor->dias_credito }} días</h6>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Estado</small>
                    <h6>
                        @if ($proveedor->estado === 'activo')
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-secondary">Inactivo</span>
                        @endif
                    </h6>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Fecha de registro</small>
                    <h6>{{ $proveedor->fecha_registro->format('d/m/Y') }}</h6>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Última actualización</small>
                    <h6>{{ $proveedor->updated_at->format('d/m/Y H:i') }}</h6>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection