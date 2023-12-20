<?php

namespace Database\Factories;

use App\Models\Personne;
use Illuminate\Database\Eloquent\Factories\Factory;


class PersonneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Personne::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $genre = $this->faker->randomElement(['male', 'female']);

        return [
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'genre' => $genre,
            'email' => $this->faker->unique()->safeEmail,
            'phonenumber' => $this->faker->phoneNumber,
            'avatar' => $genre === 'male' ? 'public/images/male.jpg' : 'public/images/female.jpg',
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'deleted_at' => null,
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Personne $personne) {
            // Create a related contact for the personne
            $personne->contact()->create([
                'fonction' => $this->faker->randomElement(['gerant', 'technicien', 'moderateur', 'commercial', 'directeur', 'autre']),
            ]);
        });
    }
}
