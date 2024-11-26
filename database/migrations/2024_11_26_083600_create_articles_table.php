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
        Schema::create('articles', function (Blueprint $table) {
            $table->integer('id_art')->primary()->autoIncrement();

            $table->string('nom_art');
            $table->string('nom_art_ar');
            $table->Text('description_art');
            $table->Text('description_art_ar');
            $table->string('code_art'); //reference

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
