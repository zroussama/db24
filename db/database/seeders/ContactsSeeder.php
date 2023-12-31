<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Personne;
use App\Models\Contact;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 50 personnes and attach contacts to them
        Personne::factory(50)->create()->each(function ($personne) {
            // Create a contact related to each personne
            $personne->contact()->save(Contact::factory()->make());
        });

    }
}
