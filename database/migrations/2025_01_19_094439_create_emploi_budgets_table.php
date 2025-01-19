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
        Schema::create('emploi_budgets', function (Blueprint $table) {
            $table->integer('id_emp')->primary()->autoIncrement();
            $table->integer('EmploiesOuverts')->nullable();
            $table->integer('EmploiesOccupes')->nullable();
            $table->integer('EmploiesVacants')->nullable();
           /* $table->string('CATEGORIE')->nullable();
            $table->integer('MOYENNE')->nullable();*/
            $table->integer('TRAITEMENT_ANNUEL')->nullable();
            $table->integer('PRIMES_INDEMNITES')->nullable();
            $table->integer('DEPENSES_ANNUELLES')->nullable();

            //pour post sup
          /* $table->integer('INDICIAIRE_NIVEAU')->nullable();
            $table->integer('INDICIAIRE_POINTS')->nullable();
            $table->integer('INDICIAIRE_MONTANT')->nullable();*/

            $table->integer('code_t1');
            $table->foreign('code_t1')->references('code_t1')->on('t1_s');


        
        });

        DB::table('emploi_budgets')->insert([
            [
             
           
                'EmploiesOuverts' => 1,
                
                'EmploiesOccupes' => 1,
                'EmploiesVacants'=> 0,
                'TRAITEMENT_ANNUEL'=>1542876,
                'PRIMES_INDEMNITES'=>2950321,
                'DEPENSES_ANNUELLES'=>4493197,


            ],
            [
                
                'EmploiesOuverts' => 2,
                
                'EmploiesOccupes' => 0,
                'EmploiesVacants'=>2,
                'TRAITEMENT_ANNUEL'=>1542876,
                'PRIMES_INDEMNITES'=>2950321,
                'DEPENSES_ANNUELLES'=>4493197,
            ]

            ]);


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emploi_budgets');
    }
};
