<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Personne;
use Illuminate\Database\Eloquent\Factories\Factory;


class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $personne = Personne::factory()->create();

        return [
            'fonction' => $this->faker->randomElement(['gerant', 'technicien', 'moderateur', 'commercial', 'directeur', 'autre']),
        ];
    }
}
