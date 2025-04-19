<?php
namespace Database\Factories;

use App\Models\Sugest;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class SugestFactory extends Factory
{
    protected $model = Sugest::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'atrativos' => $this->faker->name,
            'descricao' => $this->faker->name,
        ];
    }
}