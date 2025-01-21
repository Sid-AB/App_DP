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
            $table->integer('CATEGORIE_post');
            $table->integer('MOYENNE_post');   
            $table->integer('id_emp');
            $table->foreign('id_emp')->references('id_emp')->on('emploi_budgets');
            
           
           
        });

        DB::table('post_communs')->insert([
            [
             
                'Nom_post' => 'Administrateur conseillé',
                'CATEGORIE_post' => 16,
                'MOYENNE_post' => 1187,
                'id_emp'=>3,


            ],
           

            ]);
   
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_communs');
    }
};
