<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up()
    {
        Schema::create('bundle_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bundle_id')->constrained('collaboration_product_bundles')->onDelete('cascade');
            $table->unsignedInteger('quantity'); 
            $table->unsignedBigInteger('total_price'); 
            $table->date('sold_at');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bundle_sales');
    }
};
