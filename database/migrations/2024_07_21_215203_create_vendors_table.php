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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique();
            $table->string('address', 255);
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('main_category_id')->constrained()->on('main_categories')->onDelete('cascade');
            $table->foreignId('sub_category_id')->constrained()->on('sub_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
