<div class="row g-3">

    <div class="col-md-6">
        <label class="form-label">RTN (14 dígitos)</label>
        <input
            type="text"
            name="rtn"
            class="form-control @error('rtn') is-invalid @enderror"
            value="{{ old('rtn', $proveedor->rtn ?? '') }}"
            maxlength="14"
            minlength="14"
            pattern="[0-9]{14}"
            inputmode="numeric"
            required
        >
        @error('rtn')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Razón social / Empresa</label>
        <input
            type="text"
            name="empresa"
            class="form-control @error('empresa') is-invalid @enderror"
            value="{{ old('empresa', $proveedor->empresa ?? '') }}"
            maxlength="255"
            required
        >
        @error('empresa')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Asesor comercial</label>
        <input
            type="text"
            name="contacto"
            class="form-control @error('contacto') is-invalid @enderror"
            value="{{ old('contacto', $proveedor->contacto ?? '') }}"
            maxlength="150"
            required
        >
        @error('contacto')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Teléfono (8 dígitos)</label>
        <input
            type="tel"
            name="telefono"
            class="form-control @error('telefono') is-invalid @enderror"
            value="{{ old('telefono', $proveedor->telefono ?? '') }}"
            maxlength="8"
            minlength="8"
            pattern="[0-9]{8}"
            inputmode="numeric"
            required
        >
        @error('telefono')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Categoría</label>
        <select
            name="categorias"
            class="form-select @error('categorias') is-invalid @enderror"
            required
        >
            <option value="">Seleccionar categoría</option>

            @foreach ($categorias as $categoria)
                <option
                    value="{{ $categoria }}"
                    @selected(old('categorias', $proveedor->categorias ?? '') === $categoria)
                >
                    {{ ucfirst($categoria) }}
                </option>
            @endforeach
        </select>
        @error('categorias')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Límite de crédito (L)</label>
        <input
            type="number"
            name="limite_credito"
            class="form-control @error('limite_credito') is-invalid @enderror"
            value="{{ old('limite_credito', $proveedor->limite_credito ?? '0.00') }}"
            min="0"
            max="9999999999.99"
            step="0.01"
            required
        >
        @error('limite_credito')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Días de crédito</label>
        <select
            name="dias_credito"
            class="form-select @error('dias_credito') is-invalid @enderror"
            required
        >
            <option value="">Seleccionar plazo</option>

            @foreach ($diasCredito as $dias)
                <option
                    value="{{ $dias }}"
                    @selected((string) old('dias_credito', $proveedor->dias_credito ?? '') === (string) $dias)
                >
                    {{ $dias }} días
                </option>
            @endforeach
        </select>
        @error('dias_credito')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Estado</label>
        <select
            name="estado"
            class="form-select @error('estado') is-invalid @enderror"
            required
        >
            <option value="activo"
                @selected(old('estado', $proveedor->estado ?? 'activo') === 'activo')>
                Activo
            </option>

            <option value="inactivo"
                @selected(old('estado', $proveedor->estado ?? 'activo') === 'inactivo')>
                Inactivo
            </option>
        </select>
        @error('estado')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Fecha de registro</label>
        <input
            type="date"
            name="fecha_registro"
            class="form-control @error('fecha_registro') is-invalid @enderror"
            value="{{ old('fecha_registro', isset($proveedor) ? $proveedor->fecha_registro->format('Y-m-d') : now()->format('Y-m-d')) }}"
            required
        >
        @error('fecha_registro')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('proveedores.index') }}" class="btn btn-light">
        Cancelar
    </a>

    <button type="submit" class="btn btn-primary">
        <i class="bi bi-save me-1"></i>
        {{ $modo === 'crear' ? 'Registrar proveedor' : 'Guardar cambios' }}
    </button>
</div>