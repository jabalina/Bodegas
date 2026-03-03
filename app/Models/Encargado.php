<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encargado extends Model
{
	use HasFactory; // 2. Activa el Trait dentro de la clase
    // Permite que Laravel llene estos campos al crear un registro
    protected $fillable = ['run', 'nombre', 'primer_apellido', 'segundo_apellido', 'telefono'];

    // Accesos para obtener el nombre completo fácilmente
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->primer_apellido} {$this->segundo_apellido}";
    }

    // Relación de vuelta con Bodega (Muchos a Muchos)
    public function bodegas()
    {
        return $this->belongsToMany(Bodega::class, 'bodega_encargado', 'encargado_id', 'bodega_id');
    }
}