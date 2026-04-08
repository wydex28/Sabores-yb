<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('insumos', function (Blueprint $table) {
            $table->id();
            $table->string('material');
            $table->integer('stock');
            $table->foreignId('proveedor_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('insumos');
    }
};
