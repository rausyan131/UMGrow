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
        Schema::create('collaboration_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collaboration_id')->constrained()->onDelete('cascade');
            $table->string('task');
            $table->enum('assigned_to', ['initiator', 'partner', 'both']);
            $table->boolean('is_done')->default(false);
            $table->date('deadline')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('completed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaboration_tasks');
    }
};
