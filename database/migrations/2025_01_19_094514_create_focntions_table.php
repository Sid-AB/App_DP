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
        Schema::create('focntions', function (Blueprint $table) {
            $table->string('id_fonction')->primary()->autoIncrement();
            $table->string('Nom_fonction');
            $table->string('Nom_fonction_ar')->nullable();
            $table->float('Moyenne');
            $table->string('CATEGORIE');

            $table->integer('id_emp');
            $table->foreign('id_emp')->references('id_emp')->on('emploi_budgets');
            
        });
        DB::table('fonctions')->insert([
            [
             
                'Nom_fonction' => 'Secrétaire Général',
                'CATEGORIE'=>'E/2',
                'Moyenne' => 6767,
                'id_emp'=>1,

                
              

            ],
            [
              
                'Nom_fonction' => 'Chef de Cabinet',
                'CATEGORIE'=>'D/1',
                'Moyenne' => 6050,
                'id_emp'=>1,


            ]

            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('focntions');
    }
};
