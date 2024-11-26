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
        Schema::create('modification_t_s', function (Blueprint $table) {
            $table->integer('id_modif')->primary()->autoIncrement();

            $table->Date('date_modif');
        

            $table->float('AE_modif_t1');
            $table->float('CP_modif_t1');

            $table->float('AE_modif_t2');
            $table->float('CP_modif_t2');

            $table->float('AE_modif_t3');
            $table->float('CP_modif_t3');

            $table->float('AE_modif_t4');
            $table->float('CP_modif_t4');

            $table->integer('code_t1')->nullable();
            $table->foreign('code_t1')->references('code_t1')->on('t1_s');

            $table->integer('code_t2')->nullable();
            $table->foreign('code_t2')->references('code_t2')->on('t2_s');

            $table->integer('code_t3')->nullable();
            $table->foreign('code_t3')->references('code_t3')->on('t3_s');

            $table->integer('code_t4')->nullable();
            $table->foreign('code_t4')->references('code_t4')->on('t4_s');


            $table->integer('id_art')->nullable();
            $table->foreign('id_art')->references('id_art')->on('articles');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modification_t_s');
    }
};
