<?php

namespace Tests\Feature;

use App\Models\Client;
use Tests\TestCase;
use App\Models\Docteur;
use App\Models\Utilisateur;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthentificationTest extends TestCase
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
        $this->assertDatabaseHas('clients', $unserinsert); 

    }

    public function testRegisterAdmin(): void
    {
        $user = Utilisateur::factory()->create();
        $unserinsert = $user->toArray();
        $this->assertDatabaseHas('Utilisateurs', $unserinsert);
    }

    public function testLoginclient(): void
    {
        $user = Client::factory()->create();
        $usertr=Utilisateur::where('id',$user->utilisateur_id)->first();
        $credentials = ['email' => $usertr->email, 'password' => $usertr->password];
        $response = $this->post('api/login', $credentials);
        $response->assertStatus(200);
    } 

    public function testLogindocteur(): void
    {
        $user = Docteur::factory()->create();
        $usertr=Utilisateur::where('id',$user->utilisateurs_id)->first();
        $credentials = ['email' => $usertr->email, 'password' => $usertr->password];
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
