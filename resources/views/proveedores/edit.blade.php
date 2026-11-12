@extends('layouts.app')

@section('title', 'Editar proveedor')

@section('content')
<div class="container-fluid py-4">

    <div class="mb-4">
        <h4>Editar proveedor</h4>
        <p class="text-muted">
            Actualiza la información de {{ $proveedor->empresa }}.
        </p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('proveedores.update', $proveedor) }}" method="POST">
                @csrf
                @method('PUT')

                @php($modo = 'editar')

                @include('proveedores._form')

            </form>

        </div>
    </div>
</div>
@endsection