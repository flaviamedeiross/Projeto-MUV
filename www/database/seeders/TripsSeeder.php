<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trip;

class TripsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dados das viagens para inserir no banco
        $viagens = [
            [
                'cidade' => 'Paris',
                'pais' => 'França',
                'informacao' => 'Viagem romântica, visite a Torre Eiffel.',
                'data_partida' => '2025-07-01',
                'data_chegada' => '2025-07-10',
                'preco' => 3500.00,
                'quantidade_disponivel' => 10,
            ],
            [
                'cidade' => 'Nova York',
                'pais' => 'EUA',
                'informacao' => 'A cidade que nunca dorme, explore o Central Park.',
                'data_partida' => '2025-08-05',
                'data_chegada' => '2025-08-20',
                'preco' => 4500.00,
                'quantidade_disponivel' => 15,
            ],
            [
                'cidade' => 'Tokyo',
                'pais' => 'Japão',
                'informacao' => 'Viaje para a Terra do Sol Nascente.',
                'data_partida' => '2025-10-05',
                'data_chegada' => '2025-10-20',
                'preco' => 8500.00,
                'quantidade_disponivel' => 8,
            ],
            [
                'cidade' => 'Barcelona',
                'pais' => 'Espanha',
                'informacao' => 'Visite a Sagrada Família e a praia de Barceloneta.',
                'data_partida' => '2026-01-05',
                'data_chegada' => '2026-01-15',
                'preco' => 10500.00,
                'quantidade_disponivel' => 12,
            ],
            [
                'cidade' => 'Rio de Janeiro',
                'pais' => 'Brasil',
                'informacao' => 'Aprecie as belezas naturais, como o Cristo Redentor.',
                'data_partida' => '2025-09-05',
                'data_chegada' => '2025-09-12',
                'preco' => 4500.00,
                'quantidade_disponivel' => 20,
            ]
        ];

        // Insere as viagens no banco de dados
        foreach ($viagens as $viagem) {
            Trip::create($viagem);
        }
    }
}
