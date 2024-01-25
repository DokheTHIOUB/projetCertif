<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Client;
use App\Models\Docteur;
use App\Models\Utilisateur;
use Database\Factories\ClientFactory;
use Database\Factories\DocteurFactory;
use Tests\TestCase; 
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */

    

  
   
        /**
         * A basic feature test example.
         * // $response = $this->post('/login');
         */
        public function testresgisterClient(): void
        {
            $user = Client::factory()->create();
            $unserinsert = $user->toArray();
            $this->assertDatabaseHas('Client', $unserinsert); 

        }
    
        public function testRegisterDocteur(): void
        {
            $user = Docteur::factory()->create();
            $unserinsert = $user->toArray();
            $this->assertDatabaseHas('Docteur', $unserinsert);
           
            
        } 

        
    
        public function testLoginClient(): void
        {
            $user = Client::factory()->create();
            $credentials = ['email' => $user->email, 'password' => $user->password];
            $response = $this->post('api/login', $credentials);
            $response->assertStatus(200);
        }
    
        public function testLoginAdmin(): void
        {
            $credentials = ['email' => 'admin@gmail.com', 'password' => 'admin123'];
            $response = $this->post('api/login', $credentials);
            $response->assertStatus(200);
        }
    
    }
    

