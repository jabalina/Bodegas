<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBodegasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bodegas', function (Blueprint $table) {
            $table->id();
			$table->string('codigo', 5)->unique();
			$table->string('nombre', 100);
			$table->string('calle', 100);
			$table->string('numero', 10);
			// FK a comunas (debes tener la tabla comunas creada antes)
			$table->unsignedBigInteger('comuna_id'); 
			$table->integer('dotacion')->default(0);
			$table->string('estado', 20)->default('Activada');
			$table->foreignId('encargado_id')->nullable()->constrained('encargados')->onDelete('set null');
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
        Schema::dropIfExists('bodegas');
    }
}
