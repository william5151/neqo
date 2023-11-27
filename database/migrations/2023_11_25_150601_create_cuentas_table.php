<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id('id_cuenta');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_tipo_cuenta');
            $table->decimal('saldo', 10, 2);
            $table->boolean('matriculada_para_transferencias')->default(true);
            $table->timestamps();
            
            // Definir claves foráneas
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_tipo_cuenta')->references('id_tipo_cuenta')->on('tipos_cuentas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuentas');
    }
};
