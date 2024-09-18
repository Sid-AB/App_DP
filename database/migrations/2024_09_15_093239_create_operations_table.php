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
        Schema::create('operations', function (Blueprint $table) {
            $table->integer('code_operation')->primary();
            $table->string('nom_operation');
            $table->string('nom_operation_ar');
            $table->float('AE_operation'); //si t1 ou t4
            $table->float('CP_operation'); //si t1 ou t4

            $table->DateTime('date_insert_operation');
            $table->DateTime('date_update_operation');

            $table->float('AE_ouvert');
            $table->float('AE_atendu');
            $table->float('CP_ouvert');
            $table->float('CP_atendu');


            $table->float('AE_reporte');
            $table->float('AE_notifie');
            $table->float('AE_engage');
            $table->float('CP_reporte');
            $table->float('CP_notifie');
            $table->float('CP_consome');



            $table->integer('code_grp_operation');
            $table->foreign('code_grp_operation')->references('code_grp_operation')->on('group_operations');

            $table->integer('code_t1');
            $table->foreign('code_t1')->references('code_t1')->on('t1_s');

            $table->integer('code_t2');
            $table->foreign('code_t2')->references('code_t2')->on('t2_s');

            $table->integer('code_t3');
            $table->foreign('code_t3')->references('code_t3')->on('t3_s');

            $table->integer('code_t4');
            $table->foreign('code_t4')->references('code_t4')->on('t4_s');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};
