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
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('stock');
            $table->string('image')->nullable();
            $table->string('size')->nullable();
            $table->foreignId('sub_category_id')->constrained()->on('sub_categories')->onDelete('cascade');
            $table->foreignId('main_category_id')->constrained()->on('main_categories')->onDelete('cascade');
            $table->foreignId('vendor_id')->constrained()->on('vendors')->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained()->on('brands')->onDelete('cascade');
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
