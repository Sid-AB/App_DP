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
        Schema::create('post_contrats', function (Blueprint $table) {
            $table->integer('id_postContrat')->primary()->autoIncrement();
            $table->string('Nom_postContrat');
            $table->string('Nom_postContrat_ar')->nullable();
            $table->integer('CATEGORIE_postContrat');
            $table->integer('MOYENNE_postContrat');   
            $table->integer('id_emp');
            $table->foreign('id_emp')->references('id_emp')->on('emploi_budgets');
            
           
           
        });

        DB::table('post_contrats')->insert([
            [
             
                'Nom_postContrat' => 'Ouvrier professionnel hors catégorie',
                'CATEGORIE_postContrat' => 6,
                'MOYENNE_postContrat' => 670,
                'id_emp'=>4,


            ],
           

            ]);
   
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_contrats');
    }
};
