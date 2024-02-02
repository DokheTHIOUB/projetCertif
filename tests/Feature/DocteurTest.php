<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Docteur;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocteurTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    } 

    // public function testupdateDocteur(){
        
    //     $credentials = ['email' => 'admin@gmail.com', 'password' => 'admin123'];
    //     $response = $this->post('api/login', $credentials);
    //     $user = Docteur::factory()->create(); 
    //     $users=$user->toArray();
    //     $docteur = Docteur::FindOrFail($user->id); 
    //     $this->post('api/Docteur/edit/'.$user->id, $users);
    //     $this->assertDatabaseHas('docteurs',$users);
    //  }
    public function testReplaceDocteur()
{
    // Se connecter en tant qu'administrateur
    $credentials = ['email' => 'admin@gmail.com', 'password' => 'admin123'];
    $this->post('api/login', $credentials)->assertAuthenticated();

    // Rechercher un docteur existant
    $docteurExistant = Docteur::factory()->create();

    // Créer un nouveau docteur avec des valeurs modifiées
    $nouveauDocteur = Docteur::factory()->create([
        'anne'
    ]);

    // Effectuer la demande pour remplacer les valeurs du docteur existant
    $this->putJson("api/Docteur/update/{$docteurExistant->id}", $nouveauDocteur->toArray())
         ->assertSuccessful();

    // Vérifier que les valeurs ont été correctement mises à jour dans la base de données
    $this->assertDatabaseHas($docteurExistant->getTable(), $nouveauDocteur->toArray());
}

}
