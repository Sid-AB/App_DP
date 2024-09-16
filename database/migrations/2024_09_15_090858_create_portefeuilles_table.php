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
        Schema::create('portefeuilles', function (Blueprint $table) {
            $table->integer('num_portefeuil')->primary();
            $table->DateTime('Date_portefeuille');
            $table->string('journaux');
            $table->string('decision');
            $table->float('AE_portef');
            $table->float('CP_portef');
            $table->integer('id_min');
            $table->foreign('id_min')->references('id_min')->on('ministres');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portefeuilles');
    }
};
