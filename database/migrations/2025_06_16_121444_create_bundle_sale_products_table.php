<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration

{
    public function up()
    {
        Schema::create('bundle_sale_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bundle_sale_id')->constrained('bundle_sales')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->unsignedInteger('quantity'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bundle_sale_product');
    }
};
