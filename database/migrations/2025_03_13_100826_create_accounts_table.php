<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id(); 
            $table->string('nome'); 
            $table->string('prenom'); 
            $table->string('email')->unique();
            $table->string('post_occupe'); 
            $table->string('sous_direction'); 
            $table->string('code_generated'); 
            $table->string('privilege')->default('consluter'); // Account Status
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('accounts');
    }
};
