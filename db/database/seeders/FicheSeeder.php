<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Fiche;
use App\Models\Personne;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FicheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ficheData = [
            // Les données nécessaires pour la nouvelle Fiche
            'raison_sociale' => 'Nom de la société',
            'nom_compte' => 'Nom du compte',
            'code_client' => 'CMK123',
            'code_sous_client' => 'CMK'
        ];

        // Créer une nouvelle Fiche avec les données nécessaires
        $fiche = Fiche::create($ficheData);

        // Récupérer le contact avec la fonction "gérant"
        $gerant = Contact::where('fonction', 'gerant')->first();

        // Associer le contact à la Fiche
        $fiche->contacts()->save($gerant);

        // Seed additional Fiches if needed
        Fiche::factory(10)->create();

        // // Seed Fiche with Gerant Contact
        // $fiche = Fiche::factory()->create();

        // // Create and associate a gerant contact
        // $gerantContact = Contact::factory()->create([
        //     'fonction' => 'gerant',
        //     // Add other fields for the Contact model
        // ]);

        // $personne = Personne::factory()->create();
        // $personne->contacts()->save($gerantContact);

        // // Seed additional Fiches if needed
        // Fiche::factory(10)->create();
    }
}
