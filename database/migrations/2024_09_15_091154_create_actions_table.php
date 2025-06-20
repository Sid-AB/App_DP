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
        Schema::create('actions', function (Blueprint $table) {
            $table->string('num_action')->primary();
            $table->string('nom_action');
            $table->string('nom_action_ar')->nullable();
            $table->float('AE_action');
            $table->float('CP_action');
            $table->string('type_action')->default("centrale");

            $table->Date('date_insert_action');
            $table->DateTime('date_update_action')->nullable();

            $table->float('AE_action_NONREPARTIS')->default(0.0);
            $table->float('CP_action_NONREPARTIS')->default(0.0);
            $table->integer('id_ra')->nullable();
            $table->foreign('id_ra')->references('id_ra')->on('respo__actions');

            $table->string('num_sous_prog');
            $table->foreign('num_sous_prog')->references('num_sous_prog')->on('sous_programmes');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actions');
    }
};
