@extends('layouts.app')

@section('title', 'Registrar empleado')

@section('content')
<div class="container-fluid py-4">

    <div class="mb-4">
        <h4>Registrar personal</h4>
        <p class="text-muted">
            Ingresa la información del nuevo colaborador.
        </p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('empleados.store') }}" method="POST">
                @csrf

                @php($modo = 'crear')

                @include('empleados._form')
            </form>

        </div>
    </div>

</div>
@endsection