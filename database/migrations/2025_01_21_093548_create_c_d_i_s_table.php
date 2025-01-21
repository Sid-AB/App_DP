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
        Schema::create('c_d_i_s', function (Blueprint $table) {
            $table->integer('id_c_d_i_s')->primary()->autoIncrement();
            $table->string('Nom_c_d_i_s');
            $table->string('Nom_c_d_i_s_ar')->nullable();
            $table->string('CATEGORIE_c_d_i_s');
            $table->integer('MOYENNE_c_d_i_s');   
            
            $table->DateTime('date_insert_cdi');
            $table->DateTime('date_update_cdi');

            $table->integer('id_emp');
            $table->foreign('id_emp')->references('id_emp')->on('emploi_budgets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_d_i_s');
    }
};
