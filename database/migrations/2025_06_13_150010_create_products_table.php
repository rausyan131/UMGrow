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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('umkm_id')->constrained('umkm')->onDelete('cascade'); 
            $table->string('name');
            $table->text('description')->nullable(); 
            $table->decimal('price', 12, 2)->default(0); 
            $table->integer('stock')->default(0); 
            $table->string('image')->nullable(); 
            $table->timestamps(); 
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
