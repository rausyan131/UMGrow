<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryUmkmTable extends Migration
{
    public function up()
    {
        Schema::create('category_umkm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('umkm_id')->constrained('umkm')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['umkm_id', 'category_id']); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_umkm');
    }
}
