<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');  
            $table->string('descripcion')                   ->nullable();
            $table->string('perfil')                        ->nullable();
            $table->unsignedDecimal('masividad',    5, 0)   ->nullable();
            $table->unsignedDecimal('resistencia',  5, 0)   ->nullable();
            $table->unsignedDecimal('altura',       5, 0)   ->nullable();
            $table->unsignedDecimal('base',         5, 0)   ->nullable();
            $table->unsignedDecimal('espesor',      5, 0)   ->nullable();
            $table->string('observaciones')                 ->nullable();
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
        Schema::dropIfExists('projects');
    }
};
