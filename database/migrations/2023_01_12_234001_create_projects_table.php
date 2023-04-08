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
            $table->unsignedDecimal('base1',        5, 0)   ->nullable();
            $table->unsignedDecimal('base2',        5, 0)   ->nullable();
            $table->unsignedDecimal('espesor1',     5, 0)   ->nullable();
            $table->unsignedDecimal('espesor2',     5, 0)   ->nullable();
            $table->unsignedDecimal('espesort',     5, 0)   ->nullable();
            $table->unsignedDecimal('radio',        5, 0)   ->nullable();
            $table->unsignedDecimal('plieque',      5, 0)   ->nullable();
            $table->unsignedDecimal('diametro',     5, 0)   ->nullable();
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
