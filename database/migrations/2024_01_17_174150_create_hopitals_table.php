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
        Schema::create('hopitals', function (Blueprint $table) {
            $table->id();
            $table->string('nom_hopital');
            $table->string('description');
            $table->string('horaire'); 
            $table->string('image'); 
            $table->foreignId('localite_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hopitals');
    }
};

