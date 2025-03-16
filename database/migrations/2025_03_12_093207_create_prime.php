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
        Schema::create('prime', function (Blueprint $table) {
            $table->id();
            $table->text('nom');
            $table->integer('aep')->default(0);
            $table->integer('cpp')->default(0);
            $table->string('num_sous_action')->nullable();
            $table->timestamps(); 
            $table->foreign('num_sous_action')->references('num_sous_action')->on('sous_actions');
        });


        DB::table('prime')->insert([
            [
    
                'nom' => 'Indemnité de responsabilité, décret présidentiel n° 11-41 du 07/07/2011 des fonctions supérieures',
                'aep' => 0,
                'cpp' => 0,
                
    
            ],
            [
    
                'nom' => 'Indemnité de représentation, déc. prés. n° 11-41 du 07/07/2011',
                'aep' => 0,
                'cpp' => 0,
               
                
            ],
            [
    
                'nom' => 'Indemnité spécifique d’astreinte, décret. prés. n° 11-41 du 07/07/2011 des fonctions supérieures',
                'aep' => 0,
                'cpp' => 0,
            
            ],
            [
    
                'nom' => 'Indemnité forfaitaire pour usage de véhicule personnel,décret exécutif n° 03-178 du 15/04/2003',
                'aep' => 0,
                'cpp' => 0,
            
                
    
    
            ],
            [
    
                'nom' => 'Prime de rendement, décret exécutif n° 10-134 du 13/05/2010, complété, pour les corps communs et le décret exécutif n°10-135 du 13/05/2010, complété, pour  les corps des OP, conducteurs et appariteurs ',
                'aep' => 0,
                'cpp' => 0,
               
                
    
    
            ],
            [
    
                'nom' => 'Indemnité forfaitaire compensatrice, décret exécutif n° 08-70 du 26/02/2008, modifié,',
                'aep' => 0,
                'cpp' => 0,
             
                
            ],
            [
    
                'nom' => 'Indemnité des services administratifs communs, décret exécutif n° 10-134 du 13/05/2010, complété',
                'aep' => 0,
                'cpp' => 0,
             
            ],
            [
    
                'nom' => 'Indemnité des services techniques communs, décret exécutif n° 10-134 du 13/05/2010, complété',
                'aep' => 0,
                'cpp' => 0,
               
            ],
            [
    
                'nom' => 'Indemnité de soutien des activités administratives, décret. exécutif n° 13-188 du 09/05/2013 pour les corps communs et le décret exécutif n° 13-189 du 09/05/2013 pour les OP, conducteurs, appariteurs',
                'aep' => 0,
                'cpp' => 0,
               
            ],
            [
    
                'nom' => 'Indemnité forfaitaire de nuisance, décret exécutif n10-135 du 13/05/2010, complété ',
                'aep' => 0,
                'cpp' => 0,
               
            ],
            [
    
                'nom' => 'Prime de rendement, décret exécutif n°10-136 du13/05/2010, complété',
                'aep' => 0,
                'cpp' => 0,
               
            ],
            [
    
                'nom' => 'Indemnité de risque et d astreinte, décret exécutif n°10-136 du13/05/2010, complété',
                'aep' => 0,
                'cpp' => 0,
               
            ],
            [
    
                'nom' => 'Indemnité forfaitaire de service, décret exécutif n°10-136 du13/05/2010, complété',
                'aep' => 0,
                'cpp' => 0,
               
            ],
            [
    
                'nom' => 'Indemnité de soutien aux activités de l administration, décrets  exécutifs    n° 13-190 du 09/05/2013',
                'aep' => 0,
                'cpp' => 0,
               
            ],
            [
    
                'nom' => 'Différentiel de revenu (IDR)',
                'aep' => 0,
                'cpp' => 0,
               
            ],
            [
    
                'nom' => 'Indemnité allouée aux cadres supérieurs retraités, décret présidentiel    n°01-199  du 23/07/2001, modifié',
                'aep' => 0,
                'cpp' => 0,
               
            ],
            [
    
                'nom' => 'Indemnité de responsabilité personnelle au profit des agents comptables agréés et des régisseurs, décret exécutif n°04-308 du 22/09/2004',
                'aep' => 0,
                'cpp' => 0,
               
            ],
            [
    
                'nom' => 'Indemnité des ayants droits et fils de Chahid, loi n° 99-07 du 05 avril 1999, relatif aux combattants et ayants droits',
                'aep' => 0,
                'cpp' => 0,
               
            ],
            ]) ;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prime');
    }
};
