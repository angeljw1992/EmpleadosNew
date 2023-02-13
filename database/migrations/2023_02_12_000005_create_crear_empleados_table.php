<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrearEmpleadosTable extends Migration
{
    public function up()
    {
        Schema::create('crear_empleados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('codigo_empleado');
            $table->string('rol');
            $table->string('restaurante');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
