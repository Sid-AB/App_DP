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
            $table->string('code_generated')->default(0);
            $table->integer('update_code')->default(0); 
            $table->string('init_code')->default(0);  
            $table->timestamp('password_changed_at')->nullable();
            $table->integer('id_min')->nullable();
            $table->foreign('id_min')->references('id_min')->on('ministres');
            $table->integer('id_rp')->nullable();
            $table->foreign('id_rp')->references('id_rp')->on('respo__progs');
            $table->integer('id_ra')->nullable();
            $table->foreign('id_ra')->references('id_ra')->on('respo__actions');
            $table->string('privilege')->default(0); // Account Status
            $table->foreignId('id_deleg_resp')->nullable()->constrained('accounts')->nullOnDelete();
            $table->timestamps(); // created_at & updated_at

        });
        DB::table('accounts')->insert([
            [
                'nome'=>'Ministre',
                'prenom'=>'Ministre',
                'email'=>'Ministre@mcomm.local',
                'sous_direction'=>'Minitre',
                'post_occupe'=>'Minitre',
                'update_code'=>0,
                'init_code'=>"@mc#2025-mnc",
                'id_min'=>1,
            ], 
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('accounts');
    }

  
};
