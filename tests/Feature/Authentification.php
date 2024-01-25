<?php

namespace Tests\Feature;

use App\Models\Client;
use Tests\TestCase;
use App\Models\Docteur;
use App\Models\Utilisateur;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Authentification extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // } 


    
    public function testresgisterclient(): void
    {
        $user = Client::factory()->create();
        $unserinsert = $user->toArray();
        $this->assertDatabaseHas('client', $unserinsert); 

    }

    public function testRegisterAdmin(): void
    {
        $user = Utilisateur::factory()->create();
        $unserinsert = $user->toArray();
        $this->assertDatabaseHas('Admin', $unserinsert);
    }

    public function testLoginclient(): void
    {
        $user = Client::factory()->create();
        $credentials = ['email' => $user->email, 'password' => $user->password];
        $response = $this->post('api/login', $credentials);
        $response->assertStatus(200);
    } 

    public function testLogindocteur(): void
    {
        $user = Docteur::factory()->create();
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
