<div class="row g-3">

    <div class="col-md-6">
        <label class="form-label">Identidad (13 dígitos)</label>
        <input
            type="text"
            name="identidad"
            class="form-control @error('identidad') is-invalid @enderror"
            value="{{ old('identidad', $empleado->identidad ?? '') }}"
            maxlength="13"
            minlength="13"
            pattern="[0-9]{13}"
            inputmode="numeric"
            required
        >
        @error('identidad')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Correo electrónico</label>
        <input
            type="email"
            name="correo"
            class="form-control @error('correo') is-invalid @enderror"
            value="{{ old('correo', $empleado->correo ?? '') }}"
            maxlength="150"
            required
        >
        @error('correo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Nombre</label>
        <input
            type="text"
            name="nombre"
            class="form-control @error('nombre') is-invalid @enderror"
            value="{{ old('nombre', $empleado->nombre ?? '') }}"
            maxlength="100"
            required
        >
        @error('nombre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Apellido</label>
        <input
            type="text"
            name="apellido"
            class="form-control @error('apellido') is-invalid @enderror"
            value="{{ old('apellido', $empleado->apellido ?? '') }}"
            maxlength="100"
            required
        >
        @error('apellido')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Cargo</label>
        <select
            name="cargo"
            class="form-select @error('cargo') is-invalid @enderror"
            required
        >
            <option value="">Seleccionar cargo</option>

            @foreach ($cargos as $cargo)
                <option
                    value="{{ $cargo }}"
                    @selected(old('cargo', $empleado->cargo ?? '') === $cargo)
                >
                    {{ ucfirst($cargo) }}
                </option>
            @endforeach
        </select>
        @error('cargo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Salario mensual (L)</label>
        <input
            type="number"
            name="salario"
            class="form-control @error('salario') is-invalid @enderror"
            value="{{ old('salario', $empleado->salario ?? '') }}"
            min="0.01"
            max="99999999.99"
            step="0.01"
            required
        >
        @error('salario')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Fecha de ingreso</label>
        <input
            type="date"
            name="fecha_ingreso"
            class="form-control @error('fecha_ingreso') is-invalid @enderror"
            value="{{ old('fecha_ingreso', isset($empleado) ? $empleado->fecha_ingreso->format('Y-m-d') : now()->format('Y-m-d')) }}"
            required
        >
        @error('fecha_ingreso')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Estado del empleado</label>
        <select
            name="estado"
            class="form-select @error('estado') is-invalid @enderror"
            required
        >
            <option value="activo"
                @selected(old('estado', $empleado->estado ?? 'activo') === 'activo')>
                Activo
            </option>

            <option value="inactivo"
                @selected(old('estado', $empleado->estado ?? '') === 'inactivo')>
                Inactivo
            </option>
        </select>
        @error('estado')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('empleados.index') }}" class="btn btn-light">
        Cancelar
    </a>

    <button type="submit" class="btn btn-primary">
        <i class="bi bi-save me-1"></i>
        {{ $modo === 'crear' ? 'Registrar empleado' : 'Guardar cambios' }}
    </button>
</div>