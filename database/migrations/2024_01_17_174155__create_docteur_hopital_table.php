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
        Schema::create('docteur_hopitals', function (Blueprint $table) { 
            
            $table->id();
            $table->timestamps(); 
            $table->foreignId('docteur_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('hopitals_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
                      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docteur_hopital');
    }
};
