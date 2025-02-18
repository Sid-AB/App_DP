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
        Schema::create('sous_programmes', function (Blueprint $table) {
            $table->string('num_sous_prog')->primary();
            $table->string('nom_sous_prog');
            $table->string('nom_sous_prog_ar')->nullable();
            $table->float('AE_sous_prog');
            $table->float('CP_sous_prog');

            $table->Date('date_insert_sousProg');
            $table->DateTime('date_update_sousProg')->nullable();

            $table->float('AE_sousprog_NONREPARTIS')->default(0.0);
            $table->float('CP_sousprog_NONREPARTIS')->default(0.0);

            $table->string('num_prog');
            $table->foreign('num_prog')->references('num_prog')->on('programmes');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sous_programmes');
    }
};
