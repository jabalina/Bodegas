</body>

	<h1>Registrar Nueva Bodega</h1>

	<form action="{{ route('bodegas.store') }}" method="POST">
		@csrf
		<label for="codigo">Código de la Bodega:</label>
		<input type="text" name="codigo" id="codigo" value="{{ old('codigo') }}" required placeholder="Ej: BOD-001">		
		<label>Nombre de la Bodega:</label>
		<input type="text" name="nombre" required>

		<label>Región:</label>
		<select id="region_select" name="region_id" required>
			<option value="">Seleccione una región</option>
			@foreach($regiones as $region)
				<option value="{{ $region->id }}">{{ $region->nombre }}</option>
			@endforeach
		</select>

		<label>Comuna:</label>
		<select name="comuna_id" id="comuna_select" required disabled>
			<option value="">Seleccione primero una región</option>
		</select>
		<label for="calle">Dirección (Calle):</label>
		<input type="text" name="calle" id="calle" value="{{ old('calle') }}" placeholder="Ej: Av. Principal 123">
		<label>Numero</label>
		<input type="text" name="numero" id="numero" required>
		<label>Dotación</label>
		<input type="number" name="dotacion" id="dotacion" required>
		<button type="submit">Guardar Bodega</button>
	</form>

</body>

<script>
    document.getElementById('region_select').addEventListener('change', function() {
        let regionId = this.value;
        let comunaSelect = document.getElementById('comuna_select');

        // 1. Limpiar el selector de comunas y mostrar que está cargando
        comunaSelect.innerHTML = '<option value="">Cargando...</option>';
        comunaSelect.disabled = true;

        if (regionId) {
            // 2. Hacer la petición al endpoint de tu API
            fetch(`/api/comunas/${regionId}`)
                .then(response => response.json())
                .then(data => {
                    // 3. Limpiar y llenar el select con las comunas recibidas
                    comunaSelect.innerHTML = '<option value="">Seleccione una comuna</option>';
                    data.forEach(comuna => {
                        comunaSelect.innerHTML += `<option value="${comuna.id}">${comuna.nombre}</option>`;
                    });
                    comunaSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Error al cargar comunas:', error);
                    comunaSelect.innerHTML = '<option value="">Error, intente de nuevo</option>';
                });
        } else {
            comunaSelect.innerHTML = '<option value="">Seleccione primero una región</option>';
        }
    });
</script>

@if ($errors->any())
    <div style="color: red; background: #fee; padding: 10px; margin-bottom: 10px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif