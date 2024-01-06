<?php

namespace Database\Factories;

use App\Models\Fiche;
use Illuminate\Database\Eloquent\Factories\Factory;


class FicheFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fiche::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'raison_sociale' => $this->faker->company,
            'nom_compte' => $this->faker->userName,
            'code_client' => 'CMK' . $this->faker->unique()->numberBetween(100, 9999),
            'code_sous_client' => 'CMK',
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
