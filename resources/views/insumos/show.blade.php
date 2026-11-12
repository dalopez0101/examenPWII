
@extends('layouts.app')

@section('title', 'Detalle del insumo')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <div>
            <h4>Detalle del insumo</h4>
            <p class="text-muted mb-0">{{ $insumo->nombre }}</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('insumos.edit', $insumo) }}" class="btn btn-primary">
                <i class="bi bi-pencil me-1"></i> Editar
            </a>

            <a href="{{ route('insumos.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="row g-4">

                <div class="col-md-4 text-center">
                    @if($insumo->imagen)
                        <img src="{{ asset('storage/' . $insumo->imagen) }}"
                             alt="{{ $insumo->nombre }}"
                             class="img-fluid rounded border p-2"
                             style="max-height: 300px; object-fit: contain;">
                    @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center mx-auto"
                             style="height:250px; max-width:300px;">
                            <i class="bi bi-image text-muted" style="font-size:5rem;"></i>
                        </div>
                        <p class="text-muted mt-2">Sin imagen disponible</p>
                    @endif
                </div>

                <div class="col-md-8">
                    <h5 class="mb-3">Información general</h5>

                    <div class="row g-3">

                        <div class="col-sm-6">
                            <small class="text-muted">Código / SKU</small>
                            <p class="mb-0">{{ $insumo->codigo }}</p>
                        </div>

                        <div class="col-sm-6">
                            <small class="text-muted">Nombre</small>
                            <p class="mb-0">{{ $insumo->nombre }}</p>
                        </div>

                        <div class="col-sm-6">
                            <small class="text-muted">Categoría</small>
                            <p class="mb-0">{{ ucfirst($insumo->categoria) }}</p>
                        </div>

                        <div class="col-sm-6">
                            <small class="text-muted">Fabricante</small>
                            <p class="mb-0">{{ $insumo->fabricante ?: 'No especificado' }}</p>
                        </div>

                        <div class="col-sm-6">
                            <small class="text-muted">Costo</small>
                            <p class="mb-0">L {{ number_format((float)$insumo->costo, 2) }}</p>
                        </div>

                        <div class="col-sm-6">
                            <small class="text-muted">Precio de venta</small>
                            <p class="mb-0">L {{ number_format((float)$insumo->precio, 2) }}</p>
                        </div>

                        <div class="col-sm-6">
                            <small class="text-muted">Inventario disponible</small>
                            <p class="mb-0">
                                <span class="badge {{ $insumo->inventario <= 5 ? 'bg-danger' : 'bg-success' }}">
                                    {{ $insumo->inventario }} unidades
                                </span>
                            </p>
                        </div>

                        <div class="col-sm-6">
                            <small class="text-muted">Número de lote</small>
                            <p class="mb-0">{{ $insumo->numero_lote ?: 'No especificado' }}</p>
                        </div>

                        <div class="col-sm-6">
                            <small class="text-muted">Fecha de registro</small>
                            <p class="mb-0">
                                {{ $insumo->fecha_registro?->format('d/m/Y') ?? 'No especificada' }}
                            </p>
                        </div>

                        <div class="col-sm-6">
                            <small class="text-muted">Fecha de vencimiento</small>
                            <p class="mb-0">
                                {{ $insumo->fecha_vencimiento?->format('d/m/Y') ?? 'No aplica' }}
                            </p>
                        </div>

                        <div class="col-sm-6">
                            <small class="text-muted">Fecha de creación del registro</small>
                            <p class="mb-0">{{ $insumo->created_at?->format('d/m/Y H:i') }}</p>
                        </div>

                        <div class="col-sm-6">
                            <small class="text-muted">Última actualización</small>
                            <p class="mb-0">{{ $insumo->updated_at?->format('d/m/Y H:i') }}</p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
