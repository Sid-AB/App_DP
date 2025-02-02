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
        Schema::create('fonctions', function (Blueprint $table) {
            $table->string('id_fonction')->primary()->autoIncrement();
            $table->string('Nom_fonction');
            $table->string('Nom_fonction_ar')->nullable();
            $table->integer('Moyenne');
            $table->string('CATEGORIE');

            $table->DateTime('date_insert_fonct');
            $table->DateTime('date_update_fonct');

            $table->integer('id_emp');
            $table->foreign('id_emp')->references('id_emp')->on('emploi_budgets');
            
        });
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fonctions');
    }
};
