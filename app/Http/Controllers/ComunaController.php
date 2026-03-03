<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Comuna;
use Illuminate\Http\Request;

class ComunaController extends Controller
{
    public function getByRegion($region_id)
    {
        // Buscamos las comunas que pertenecen al ID de la región enviada
        $comunas = Comuna::where('region_id', $region_id)->get(['id', 'nombre']);
        
        // Retornamos los datos como JSON para que JavaScript los entienda
        return response()->json($comunas);
    }
	
	public function create()
	{
		// Obtenemos todas las regiones para el select
		$regiones = \App\Models\Region::all();
		
		// Retornamos la vista pasando las regiones
		return view('bodegas.create', compact('regiones'));
	}
	
	public function edit(Bodega $bodega)
	{
		// 1. Necesitas obtener las regiones de la base de datos
		$regiones = \App\Models\Region::all();
		
		// 2. Necesitas las comunas (o puedes filtrar las comunas de la región actual)
		$comunas = \App\Models\Comuna::all();

		// 3. ¡IMPORTANTE! Debes incluir 'regiones' en el compact
		return view('bodegas.edit', compact('bodega', 'comunas', 'regiones'));
	}
}
