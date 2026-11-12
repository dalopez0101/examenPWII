@extends('layouts.app')

@section('title', 'Registrar proveedor')

@section('content')
<div class="container-fluid py-4">

    <div class="mb-4">
        <h4>Registrar proveedor agrícola</h4>
        <p class="text-muted">Completa la información del fabricante o importador.</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('proveedores.store') }}" method="POST">
                @csrf

                @php($modo = 'crear')

                @include('proveedores._form')

            </form>

        </div>
    </div>
</div>
@endsection