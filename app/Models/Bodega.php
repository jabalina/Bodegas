<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bodega extends Model
{
	use HasFactory; // Aquí activas el Trait
    // Esto autoriza a Laravel a llenar estos campos desde el formulario
    protected $fillable = ['nombre', 'codigo', 'calle', 'comuna_id', 'numero', 'dotacion'];

    // Opcional: Definir la relación con Comuna
    public function comuna()
    {
        return $this->belongsTo(Comuna::class);
    }
	
	public function region() {
    
		return $this->belongsTo(Region::class);
	}
	
	public function encargado()
    {
        // Esto asume que tienes una tabla de usuarios/encargados
        return $this->belongsTo(User::class, 'encargado_id');
    }
	
	public function encargados()
	{
		// Usamos el nombre real de tu tabla: 'encargados'
		return $this->belongsToMany(Encargado::class, 'bodega_encargado', 'bodega_id', 'encargado_id')
					->withTimestamps();
	}
	public function scopeEstado($query, $estado)
	{
		if ($estado) {
			return $query->where('estado', $estado);
		}
		return $query;
	}
}
