<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')                    ->constrained(); 
            $table->unsignedBigInteger('user_project_counter');
            $table->string('project');  
            $table->string('description',1000)               ->nullable();
            $table->string('observations',1000)              ->nullable();    
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')                 ->constrained(); 
            // $table->unsignedBigInteger('project_profile_counter');
            $table->string('nombre');
            $table->string('descripcion',1000)              ->nullable();
            $table->string('exposicion')                    ->nullable();
            $table->string('perfil')                        ->nullable();
            $table->string('forma')                         ->nullable();
            $table->decimal('masividad',    5, 2)->unsigned()->nullable();
            $table->decimal('resistencia',  5, 2)->unsigned()->nullable();
            $table->decimal('altura',       5, 2)->unsigned()->nullable();
            $table->decimal('base1',        5, 2)->unsigned()->nullable();
            $table->decimal('base2',        5, 2)->unsigned()->nullable();
            $table->decimal('espesor1',     5, 2)->unsigned()->nullable();
            $table->decimal('espesor2',     5, 2)->unsigned()->nullable();
            $table->decimal('espesort',     5, 2)->unsigned()->nullable();
            $table->decimal('radio',        5, 2)->unsigned()->nullable();
            $table->decimal('plieque',      5, 2)->unsigned()->nullable();
            $table->decimal('diametro',     5, 2)->unsigned()->nullable();
            $table->string('observaciones', 1000)           ->nullable();
            $table->boolean('incluir')                      ->default(false);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')                 ->constrained(); 
            $table->string('pintura')                       ->nullable();
            $table->string('modelo')                        ->nullable();
            $table->string('certificado')                   ->nullable();
            $table->string('numero')                        ->nullable();
            $table->string('minimo')                        ->nullable();
            $table->boolean('incluir')                      ->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('results');
    }
};
