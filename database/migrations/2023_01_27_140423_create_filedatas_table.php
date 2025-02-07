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
        Schema::create('filedatas', function (Blueprint $table) {
            $table->id();
            $table->string('pintura');  
            $table->string('modelo')        ->nullable();
            $table->string('certificado')   ->nullable();
            $table->string('numero')        ->nullable();
            $table->string('masividad')     ->nullable();
            $table->string('m15')           ->nullable();
            $table->string('m30')           ->nullable();
            $table->string('m60')           ->nullable();
            $table->string('m90')           ->nullable();
            $table->string('m120')          ->nullable();
            $table->string('p4c')           ->nullable();
            $table->string('v4c')           ->nullable();
            $table->string('v3c')           ->nullable();
            $table->string('abierta')       ->nullable();
            $table->string('rectangular')   ->nullable();
            $table->string('circular')      ->nullable();
            $table->integer('orden')        ->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('filedatas');
    }
};
