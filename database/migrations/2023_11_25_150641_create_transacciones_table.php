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
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id('id_transaccion');
            $table->unsignedBigInteger('id_cuenta_origen');
            $table->unsignedBigInteger('id_cuenta_destino');
            $table->decimal('monto', 10, 2);
            $table->timestamps();

            // Definir claves foráneas
            $table->foreign('id_cuenta_origen')->references('id_cuenta')->on('cuentas');
            $table->foreign('id_cuenta_destino')->references('id_cuenta')->on('cuentas');
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacciones');
    }
};
