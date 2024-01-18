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
      
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('Prenom');
            $table->enum('sexe', ['homme', 'femme'])->nullable(); 
            $table->string('age');
            $table->string('telephone');
            $table->enum('role',['client','admin','docteur'])->default('client');
            $table->string('email')->unique(); 
            $table->string('password');
            $table->string('adresse');
            $table->string('photo_profil')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
