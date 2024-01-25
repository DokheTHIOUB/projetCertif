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
        Schema::create('hopitauxs', function (Blueprint $table) {
            $table->id();
            $table->string('nom_hopital');
            $table->string('description');
            $table->string('lattitude');
            $table->string('longitude'); 
            $table->string('horaire'); 
            $table->foreignId('localite_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hopitaux');
    }
};
