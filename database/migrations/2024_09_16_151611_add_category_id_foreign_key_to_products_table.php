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
        Schema::table('products', function (Blueprint $table) {
                // Ensure the column exists and is of the correct type
                $table->unsignedBigInteger('category_id')->change();

                // Add the foreign key constraint
                $table->foreign('category_id')
                      ->references('id')
                      ->on('categories')
                      ->nullOnDeleteonDelete(); // Use 'restrict', 'cascade', or other as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
             // Drop the foreign key constraint
             $table->dropForeign(['category_id']);
        });
    }
};
