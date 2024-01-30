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
            $table->string('numero_licence');
            $table->string('annee_experience');  
            $table->enum('statut',['disponible','indisponible']);  
            $table->foreignId('specialite_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('utilisateurs_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
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
