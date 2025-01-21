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
        Schema::create('post_communs', function (Blueprint $table) {
            $table->integer('id_post')->primary()->autoIncrement();
            $table->string('Nom_post');
            $table->string('Nom_post_ar')->nullable();
            $table->string('CATEGORIE_post');
            $table->integer('MOYENNE_post');   
            
            $table->DateTime('date_insert_postcommun');
            $table->DateTime('date_update_postcommun');

            $table->integer('id_emp');
            $table->foreign('id_emp')->references('id_emp')->on('emploi_budgets');
            
           
           
        });

       
   
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_communs');
    }
};
