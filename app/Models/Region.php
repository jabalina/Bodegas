<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    // Si tu tabla en la base de datos se llama 'regiones' (en plural),
    // Laravel la detecta automáticamente. Si se llama distinto, 
    // puedes especificarlo aquí:
    // protected $table = 'regiones';

    /**
     * Una Región tiene muchas Comunas.
     * Esta relación es necesaria para el 'with('comuna.region')' que usas.
     */
    public function comunas()
    {
        return $this->hasMany(Comuna::class);
    }
}