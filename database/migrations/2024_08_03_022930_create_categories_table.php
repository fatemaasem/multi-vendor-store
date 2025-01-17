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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('slug')->unique();
            $table->foreignId('parent_cat_id')
            ->nullable()->constrained('categories','id')
            ->nullOnDelete();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->enum('status',['active','archived']);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
