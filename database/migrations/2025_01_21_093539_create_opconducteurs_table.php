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
        Schema::create('opconducteurs', function (Blueprint $table) {
            $table->integer('id_opconducteurs')->primary()->autoIncrement();
            $table->string('Nom_opconducteurs');
            $table->string('Nom_opconducteurs_ar')->nullable();
            $table->string('CATEGORIE_opconducteurs');
            $table->integer('MOYENNE_opconducteurs');   
            
            $table->DateTime('date_insert_opconducteur');
            $table->DateTime('date_update_opconducteur');

            $table->integer('id_emp');
            $table->foreign('id_emp')->references('id_emp')->on('emploi_budgets');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opconducteurs');
    }
};
