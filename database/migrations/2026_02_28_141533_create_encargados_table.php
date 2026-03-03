<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEncargadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encargados', function (Blueprint $table) {
            $table->id();
			$table->string('run', 12)->unique();
			$table->string('nombre', 50);
			$table->string('primer_apellido', 50);
			$table->string('segundo_apellido', 50)->nullable();
			$table->string('telefono', 20)->nullable();
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
        Schema::dropIfExists('encargados');
    }
}
