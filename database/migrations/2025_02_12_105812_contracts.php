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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id('id_contract');
            $table->date('date_end');
            $table->date('date_start');
            $table->text('content');
            $table->decimal('monthly_price', 10, 2);
            $table->foreignId('id_box')->references('id_box')->on('boxes');
            $table->foreignId('id_tenant')->references('id_tenant')->on('tenants');
            $table->foreignId('id_user')->references('ID_user')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
