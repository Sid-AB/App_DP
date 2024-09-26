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
            $table->bigInteger('num_portefeuil')->primary();
            $table->DateTime('Date_portefeuille');
            $table->string('nom_journal');
            $table->integer('num_journal');
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
