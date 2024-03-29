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
        Schema::create('docteurs', function (Blueprint $table) {
            $table->id(); 
            $table->string('diplome');
            $table->string('specialite');
            $table->string('numero_licence');
            $table->string('annee_experience');
            $table->string('hopitaux_frequente');
            $table->enum('statut',['disponible','indisponible'])->default('disponible'); 
            $table->unsignedBigInteger('utilisateur_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docteurs');
    }
};
