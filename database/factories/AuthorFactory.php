<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'birth_date'=>'2020/10/10',
            'death_date'=> '2024/10/10',
            'nationality'=>fake()->country(),
            'about'=>fake()->text(),
        ];
    }
}
