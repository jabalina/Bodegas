<h1>Listado de Bodegas</h1>
<a href="{{ route('bodegas.create') }}">Crear nueva bodega</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif
<form action="{{ route('bodegas.index') }}" method="GET">
    <select name="estado" onchange="this.form.submit()">
        <option value="">Todas las bodegas</option>
        <option value="Activa" {{ request('estado') == 'Activa' ? 'selected' : '' }}>Activas</option>
        <option value="Inactiva" {{ request('estado') == 'Inactiva' ? 'selected' : '' }}>Inactivas</option>
    </select>
</form>

<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Código</th>
			<th>Calle</th>
			<th>Numero</th>
			<th>Comuna</th>
			<th>Region</th>
			<th>Dotacion</th>
			<th>Estado</th>
			<th>Encargados</th>
			<th>Editar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bodegas as $bodega)
        <tr>
            <td>{{ $bodega->nombre }}</td>
            <td>{{ $bodega->codigo }}</td>
			<td>{{ $bodega->calle }}</td>
			<td>{{ $bodega->numero }}</td>
			<td>{{ $bodega->comuna ? $bodega->comuna->nombre : 'Sin comuna' }}</td>
            <td>{{ ($bodega->comuna && $bodega->comuna->region) ? $bodega->comuna->region->nombre : 'Sin región' }}</td>
			<td>{{ $bodega->dotacion }}</td>
			<td>{{ $bodega->estado }}</td>
			<td>
				@if($bodega->encargados->isEmpty())
					<em>Sin encargados</em>
				@else
					{{ $bodega->encargados->pluck('nombre_completo')->implode(', ') }}
				@endif
			</td>
			<td><a href="{{ route('bodegas.edit', $bodega->id) }}">Editar</a></td>
			<td>
				<form action="{{ route('bodegas.destroy', $bodega->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta bodega?');">
					@csrf
					@method('DELETE')
					
					<button type="submit" class="btn btn-danger btn-sm">
						Eliminar
					</button>
				</form>
			</td>
        </tr>
        @endforeach
    </tbody>
</table>