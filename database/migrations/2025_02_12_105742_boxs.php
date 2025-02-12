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
            $table->id();
            $table->string('Nom', 50);
            $table->string('Adresse', 255)->nullable();
            $table->text('Description')->nullable();
            $table->string('Type', 50);
            $table->foreignId('ID_locataire')->constrained('locataires', 'ID_locataire');
            $table->foreignId('ID_user')->constrained('users', 'ID_user');
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
