
@extends('layouts.app')

@section('title', 'Editar insumo')

@section('content')
<div class="container-fluid py-4">

    <div class="mb-4">
        <h4>Editar insumo</h4>
        <p class="text-muted mb-0">
            Modificando: {{ $insumo->nombre }}
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Información del insumo</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('insumos.update', $insumo) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                @php($modo = 'editar')
                @include('insumos._form')

            </form>
        </div>
    </div>

</div>
@endsection
