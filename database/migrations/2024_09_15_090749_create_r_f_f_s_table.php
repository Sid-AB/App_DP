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
        Schema::create('r_f_f_s', function (Blueprint $table) {
            $table->integer('id_rff')->primary();
            $table->Date('Date_installation_rff');
            $table->integer('id_nin');
            $table->foreign('id_nin')->references('id_nin')->on('personnes');
        });

        DB::table('r_f_f_s')->insert([
            [
                'id_rff'=>1,
                'Date_installation_rff' => '2024-02-19',
                'id_nin' => 4,
             
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r_f_f_s');
    }
};
