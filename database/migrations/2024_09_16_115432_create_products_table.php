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
            $table->string('name',255);
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->foreignId('store_id')->nullable()
            ->constrained('stores')
            ->onDelete('cascade');
             $table->foreignId('category_id');
            $table->string('image')->nullable();
            $table->enum('status',['active','draft','archived']);
            $table->float('price')->default(0);
            $table->float('compare_price')->nullable();
            $table->boolean('featured')->default(0);
            $table->float('rating')->default(0);
            $table->json('options')->nullable();
            $table->softDeletes();
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
