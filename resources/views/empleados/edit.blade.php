@extends('layouts.app')

@section('title', 'Editar empleado')

@section('content')
<div class="container-fluid py-4">

    <div class="mb-4">
        <h4>Editar información del empleado</h4>
        <p class="text-muted">
            Actualizando a {{ $empleado->nombre }} {{ $empleado->apellido }}.
        </p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('empleados.update', $empleado) }}" method="POST">
                @csrf
                @method('PUT')

                @php($modo = 'editar')

                @include('empleados._form')
            </form>

        </div>
    </div>

</div>
@endsection