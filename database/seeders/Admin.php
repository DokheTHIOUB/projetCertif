<?php

namespace Database\Seeders;

use App\Models\Utilisateur;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     */

        public function run(): void
        {
            Utilisateur::create([
                "nom" => "admin",
                "prenom" => "admin",
                "sexe" => "femme",
                "age" => "20",
                "telephone" => 776748180,
                "email" => "thioub@gmail.com", 
                "adresse" => "medina",
                "photo_profil" => "fghj,k;lm",
                "password" => Hash::make('thioubdokhe'),
                "role" => "admin",
            ]);
        }
    
}
