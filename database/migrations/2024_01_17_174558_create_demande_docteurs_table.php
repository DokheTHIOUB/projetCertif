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
        Schema::create('demande_docteurs', function (Blueprint $table) {
            $table->id(); 
            $table->string('demande');
            $table->enum('etat_demande',['accepter','decliner']);
            $table->unsignedBigInteger('docteur_id');
            $table->unsignedBigInteger('client_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_docteurs');
    }
};
