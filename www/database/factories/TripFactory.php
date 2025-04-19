<?php
namespace Database\Factories;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    protected $model = Trip::class;

    public function definition()
    {
        return [
            'cidade' => $this->faker->city,
            'pais' => $this->faker->country,
            'informacao' => $this->faker->sentence,
            'data_partida' => $this->faker->dateTimeBetween('+1 week', '+2 weeks')->format('Y-m-d'),
            'data_chegada' => $this->faker->dateTimeBetween('+2 weeks', '+3 weeks')->format('Y-m-d'),
            'preco' => $this->faker->numberBetween(500, 10000),
            'quantidade_disponivel' => $this->faker->numberBetween(1, 50),
        ];
    }
}