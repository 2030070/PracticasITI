<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\posts>
 */
class postsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //llenamos la tabla de post con datos demo
            'titulo'=>$this->faker->sentence(5),
            'descripcion'=>$this->faker->sentence(26),
            'imagen'=>$this->faker->uuid().'.jpg',
            //agregamos a los usuarios para las pruebas
            'user_id'=>$this->faker->randomElement([1,2,3])
        ];
    }
}
