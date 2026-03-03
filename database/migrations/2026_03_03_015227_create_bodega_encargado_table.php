<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBodegaEncargadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('bodega_encargado', function (Blueprint $table) {
			$table->id();
			// Usamos los nombres estándar: nombre_del_modelo_en_singular + _id
			$table->foreignId('bodega_id')->constrained('bodegas')->onDelete('cascade');
			$table->foreignId('encargado_id')->constrained('encargados')->onDelete('cascade');
			$table->timestamps();
		});
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bodega_encargado');
    }
}
