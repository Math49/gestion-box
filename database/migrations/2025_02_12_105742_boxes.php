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
        Schema::create('boxes', function (Blueprint $table) {
            $table->id('id_box');
            $table->string('name', 50);
            $table->string('address', 255)->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->foreignId('id_owner')->references('id_user')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boxes');
    }
};
