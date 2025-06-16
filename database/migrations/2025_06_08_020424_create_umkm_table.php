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
        Schema::create('umkm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->string('umkm_name', 255);
            $table->text('description')->nullable();
            $table->text('location')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('website_url', 255)->nullable();
            $table->string('instagram_url', 255)->nullable();
            $table->string('facebook_url', 255)->nullable();
            $table->string('image', 255)->nullable();
            
            $table->json('gallery')->nullable();       
            $table->json('certificates')->nullable();
    
            $table->boolean('is_profile_complete')->default(false);
            $table->timestamps();
        });
    }
    
 
    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};
