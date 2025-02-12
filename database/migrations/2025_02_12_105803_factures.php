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
        Schema::create('factures', function (Blueprint $table) {
            $table->id('ID_facture');
            $table->boolean('Paye');
            $table->string('Lien',255);
            $table->date('Date_creation');
            $table->decimal('Montant', 15, 2);
            $table->foreignId('ID_locataire')->references('ID_locataire')->on('locataires');
            $table->foreignId('ID_user')->references('ID_user')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
