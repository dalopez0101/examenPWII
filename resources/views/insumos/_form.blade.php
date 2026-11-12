
<div class="row g-3">

    <div class="col-md-6">
        <label for="codigo" class="form-label">Código / SKU *</label>
        <input type="text" name="codigo" id="codigo"
               class="form-control @error('codigo') is-invalid @enderror"
               value="{{ old('codigo', $insumo->codigo ?? '') }}"
               maxlength="50" required>
        @error('codigo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="nombre" class="form-label">Nombre *</label>
        <input type="text" name="nombre" id="nombre"
               class="form-control @error('nombre') is-invalid @enderror"
               value="{{ old('nombre', $insumo->nombre ?? '') }}"
               maxlength="150" required>
        @error('nombre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="categoria" class="form-label">Categoría *</label>
        <select name="categoria" id="categoria"
                class="form-select @error('categoria') is-invalid @enderror" required>
            <option value="">Seleccione una categoría</option>

            @foreach($categorias as $categoria)
                <option value="{{ $categoria }}"
                    {{ old('categoria', $insumo->categoria ?? '') == $categoria ? 'selected' : '' }}>
                    {{ ucfirst($categoria) }}
                </option>
            @endforeach
        </select>
        @error('categoria')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="fabricante" class="form-label">Fabricante</label>
        <input type="text" name="fabricante" id="fabricante"
               class="form-control @error('fabricante') is-invalid @enderror"
               value="{{ old('fabricante', $insumo->fabricante ?? '') }}"
               maxlength="150">
        @error('fabricante')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="costo" class="form-label">Costo (L) *</label>
        <input type="number" name="costo" id="costo"
               class="form-control @error('costo') is-invalid @enderror"
               value="{{ old('costo', $insumo->costo ?? '') }}"
               min="0" step="0.01" required>
        @error('costo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="precio" class="form-label">Precio de venta (L) *</label>
        <input type="number" name="precio" id="precio"
               class="form-control @error('precio') is-invalid @enderror"
               value="{{ old('precio', $insumo->precio ?? '') }}"
               min="0" step="0.01" required>
        @error('precio')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="inventario" class="form-label">Cantidad en inventario *</label>
        <input type="number" name="inventario" id="inventario"
               class="form-control @error('inventario') is-invalid @enderror"
               value="{{ old('inventario', $insumo->inventario ?? 0) }}"
               min="0" step="1" required>
        @error('inventario')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="numero_lote" class="form-label">Número de lote</label>
        <input type="text" name="numero_lote" id="numero_lote"
               class="form-control @error('numero_lote') is-invalid @enderror"
               value="{{ old('numero_lote', $insumo->numero_lote ?? '') }}"
               maxlength="100">
        @error('numero_lote')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="fecha_registro" class="form-label">Fecha de registro *</label>
        <input type="date" name="fecha_registro" id="fecha_registro"
               class="form-control @error('fecha_registro') is-invalid @enderror"
               value="{{ old('fecha_registro', isset($insumo) && $insumo->fecha_registro ? $insumo->fecha_registro->format('Y-m-d') : now()->format('Y-m-d')) }}"
               required>
        @error('fecha_registro')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento</label>
        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento"
               class="form-control @error('fecha_vencimiento') is-invalid @enderror"
               value="{{ old('fecha_vencimiento', isset($insumo) && $insumo->fecha_vencimiento ? $insumo->fecha_vencimiento->format('Y-m-d') : '') }}">
        @error('fecha_vencimiento')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="imagen" class="form-label">Imagen del insumo</label>
        <input type="file" name="imagen" id="imagen"
               class="form-control @error('imagen') is-invalid @enderror"
               accept="image/*">
        <div class="form-text">Formatos de imagen permitidos. Tamaño máximo: 2 MB.</div>

        @error('imagen')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        @if(isset($insumo) && $insumo->imagen)
            <div class="mt-3">
                <p class="mb-2">Imagen actual:</p>
                <img src="{{ asset('storage/' . $insumo->imagen) }}"
                     alt="{{ $insumo->nombre }}"
                     style="max-width: 150px; max-height: 150px; object-fit: contain;"
                     class="rounded border p-1">
            </div>
        @endif
    </div>

</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('insumos.index') }}" class="btn btn-outline-secondary">
        Cancelar
    </a>

    <button type="submit" class="btn btn-primary">
        <i class="bi bi-save me-1"></i>
        {{ $modo === 'crear' ? 'Guardar insumo' : 'Actualizar insumo' }}
    </button>
</div>
