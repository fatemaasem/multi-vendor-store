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
        Schema::create('profiles', function (Blueprint $table) {
           
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->primary('user_id');
            $table->string('f_name');
            $table->string('s_name');
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->char('country');
            $table->string('postal_code')->nullable();
            $table->string('lang')->nullable();
            $table->enum('gender',['male','female']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
