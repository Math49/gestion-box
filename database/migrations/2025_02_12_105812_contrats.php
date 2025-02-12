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
            $table->foreignId('ID_locataire')->references('ID_locataire')->on('locataires');
            $table->foreignId('ID_box')->references('ID_box')->on('boxs');
            $table->foreignId('ID_user')->references('ID_user')->on('users');
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
