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
        Schema::create('boxs', function (Blueprint $table) {
            $table->id('ID_box');
            $table->string('Nom', 50);
            $table->string('Adresse', 255)->nullable();
            $table->text('Description')->nullable();
            $table->string('Type', 50);
            $table->foreignId('ID_locataire')->nullable()->references('ID_locataire')->on('locataires');
            $table->foreignId('ID_user')->references('ID_user')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boxs');
    }
};
