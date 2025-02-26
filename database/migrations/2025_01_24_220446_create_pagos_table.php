<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('suscripcion_id')->nullable()->constrained('suscripciones')->onDelete('cascade');
            $table->decimal('monto', 8, 2);
            $table->string('metodo_pago'); // Ej.: "Tarjeta", "Transferencia"
            $table->string('estado')->default('Pendiente'); // Ej.: "Exitoso", "Fallido"
            $table->string('referencia')->nullable(); // Identificador de la pasarela
            $table->date('fecha');
            $table->timestamps();
        });
    }
    

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
