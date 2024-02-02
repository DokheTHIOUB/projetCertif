<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Avis;
use App\Models\Client;
use App\Models\Utilisateur;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AvisTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    // public function testAjouterAvi(): void
    // {
    //     $user = Client::factory()->create();
    //     $usertr=Utilisateur::where('id',$user->utilisateur_id)->first();
    //     $createUser= Utilisateur::factory()->create(['email' => 'HNAA@gmail.com', 'password' => 'petit1234']);
    //     $this->actingAs($createUser,'api');
    //     $Avis= Avis::factory()->create();
    //     $Avis=$Avis->toArray();
    //     $this->assertDatabaseHas('avis',$Avis);
    // }

    // public function testSupprimerCommentaire(): void
    // {
    //     $createUser= User::factory()->create(['email' => 'HNAA@gmail.com', 'password' => '123456']);
    //     $this->actingAs($createUser,'api');
    //     $commentaire=Commentaire::Find(3);
    //     $response = $this->delete('api/supprimerCommentaire/'.$commentaire->id);
    //     $response->assertStatus(200);
    // }

    // public function testListeCommentaire()
    // {
    //     $response=$this->get('api/listerCommentaires/3');
    //     $response->assertStatus(200);
    // }

    // public function testNombreCommentaire()
    // {
    //     $response=$this->get('api/compterCommentaires/3');
    //     $response->assertStatus(200);
    // }
    
}
