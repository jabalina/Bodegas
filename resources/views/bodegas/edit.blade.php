<form action="{{ route('bodegas.update', $bodega->id) }}" method="POST">
    @csrf
    @method('PUT') 
    <label for="codigo">Código de la Bodega:</label>
	<input type="text" name="codigo" id="codigo" value="{{ old('codigo', $bodega->codigo) }}">		
	<label>Nombre de la Bodega:</label>
	<input type="text" name="nombre" value="{{ old('nombre', $bodega->nombre) }}">

	<label>Región:</label>
	<select name="region_id" id="region_select">
		<option value="">Seleccione una región</option>
		@foreach($regiones as $region)
			<option value="{{ $region->id }}" 
				{{ $bodega->comuna->region_id == $region->id ? 'selected' : '' }}>
				{{ $region->nombre }}
			</option>
		@endforeach
	</select>

	<label>Comuna:</label>
	<select name="comuna_id" id="comuna_select">
		<option value="{{ $bodega->comuna_id }}">{{ $bodega->comuna->nombre }}</option>
	</select>


	<label for="calle">Dirección (Calle):</label>
	<input type="text" name="calle" id="calle" value="{{ old('calle', $bodega->calle) }}">
	<label>Numero</label>
	<input type="text" name="numero" id="numero" value="{{ old('numero', $bodega->numero) }}">
	<label>Dotación</label>
	<input type="number" name="dotacion" id="dotacion" value="{{ old('dotacion', $bodega->dotacion) }}">

    <button type="submit">Actualizar Bodega</button>
</form>

<script>
	document.getElementById('region_select').addEventListener('change', function() {
		let regionId = this.value;
		let comunaSelect = document.getElementById('comuna_select');

		// Limpiamos el combo de comunas
		comunaSelect.innerHTML = '<option value="">Cargando...</option>';

		if (regionId) {
			fetch(`/api/comunas-por-region/${regionId}`)
				.then(response => response.json())
				.then(data => {
					comunaSelect.innerHTML = '<option value="">Seleccione una comuna</option>';
					data.forEach(comuna => {
						comunaSelect.innerHTML += `<option value="${comuna.id}">${comuna.nombre}</option>`;
					});
				});
		}
	});
</script>