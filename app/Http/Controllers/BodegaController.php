<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bodega;
use App\Models\Region;
use App\Models\Comuna; 

class BodegaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function index(Request $request)
	{
		// Comenzamos la consulta con Eager Loading ('encargado')
		$query = Bodega::with('encargado');

		// Aplicar filtro si el estado existe y no es 'ambos'
		if ($request->has('estado') && $request->estado !== 'todos') {
			$query->where('estado', $request->estado);
		}

		$bodegas = \App\Models\Bodega::with(['comuna.region', 'encargados'])
			->when($request->has('estado') && $request->estado != '', function ($query) use ($request) {
				$query->where('estado', $request->estado);
			})
			->get();

		return view('bodegas.index', compact('bodegas'));
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regiones = \App\Models\Region::all();
		// ¡Asegúrate de que este 'return' exista!
		return view('bodegas.create', compact('regiones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function store(Request $request)
	{
		// 1. Validamos que los datos vengan correctos
		$request->validate([
			'nombre'    => 'required|max:255',
			'codigo'    => 'required|unique:bodegas,codigo',
			'comuna_id' => 'required|exists:comunas,id',
			'calle' 	=> 'required|string|max:255',
			'numero'	=> 'required|string|max:255',
			'dotacion'	=> 'required|numeric',
		]);

		// 2. Creamos la bodega
		\App\Models\Bodega::create([
			'nombre'    => $request->nombre,
			'codigo'    => $request->codigo,
			'comuna_id' => $request->comuna_id,
			'calle' 	=> $request->calle,
			'numero' 	=> $request->numero,
			'dotacion'	=> $request->dotacion,
		]);

		// 3. Redirigimos al listado con un mensaje de éxito
		return redirect()->route('bodegas.index')->with('success', 'Bodega creada con éxito');
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 
	public function edit(Bodega $bodega)
	{
		// 1. Obtener todas las regiones para el combobox
		$regiones = \App\Models\Region::all();
		
		// 2. Pasar $regiones a la vista usando compact()
		// Asegúrate de que los nombres coincidan exactamente con lo que usas en el blade
		return view('bodegas.edit', compact('bodega', 'regiones'));
	}

	public function update(Request $request, Bodega $bodega)
	{
		$request->validate([
			'nombre'    => 'required|max:255',
			'codigo'    => 'required|unique:bodegas,codigo,' . $bodega->id,
			'comuna_id' => 'required|exists:comunas,id',
			'calle' 	=> 'required|string|max:255',
			'numero'	=> 'required|string|max:255',
			'dotacion'	=> 'required|numeric',
		]);

		$bodega->update($request->all());

		return redirect()->route('bodegas.index')->with('success', 'Bodega actualizada con éxito.');
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function destroy($id)
	{
		$bodega = \App\Models\Bodega::findOrFail($id);
		
		// Al borrar la bodega, Laravel eliminará automáticamente 
		// la relación en la tabla pivote si configuraste 'onDelete cascade' 
		// en tu migración.
		$bodega->delete();

		return redirect()->route('bodegas.index')->with('success', 'Bodega eliminada correctamente');
	}
}
