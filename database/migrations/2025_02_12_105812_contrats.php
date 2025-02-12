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
        Schema::create('contrats', function (Blueprint $table) {
            $table->id('ID_contrat');
            $table->string('Status', 50);
            $table->string('Lien',255);
            $table->date('Date_debut');
            $table->date('Date_fin')->nullable();
            $table->foreignId('ID_locataire')->constrained('locataires', 'ID_locataire');
            $table->foreignId('ID_box')->constrained('boxs', 'ID_box');
            $table->foreignId('ID_user')->constrained('users', 'ID_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrats');
    }
};
