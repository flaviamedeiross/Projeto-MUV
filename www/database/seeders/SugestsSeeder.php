<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sugest;
use App\Models\Trip;

class SugestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dados das sugestões de lugares, com a viagem associada
        $sugests = [
            [
                'nome' => 'Torre Eiffel',
                'descricao' => 'Um dos pontos turísticos mais famosos do mundo, localizada em Paris.',
                'interesse' => 'História',
                'trip_id' => Trip::where('cidade', 'Paris')->first()->id,
            ],
            [
                'nome' => 'Central Park',
                'descricao' => 'Parque famoso de Nova York, perfeito para caminhadas e piqueniques.',
                'interesse' => 'Natureza',
                'trip_id' => Trip::where('cidade', 'Nova York')->first()->id,
            ],
            [
                'nome' => 'Sagrada Família',
                'descricao' => 'Uma das obras mais icônicas de Gaudí, em Barcelona.',
                'interesse' => 'Cultura',
                'trip_id' => Trip::where('cidade', 'Barcelona')->first()->id,
            ],
            [
                'nome' => 'Cristo Redentor',
                'descricao' => 'Uma das 7 maravilhas do mundo moderno, localizada no Rio de Janeiro.',
                'interesse' => 'Religião',
                'trip_id' => Trip::where('cidade', 'Rio de Janeiro')->first()->id,
            ],
            [
                'nome' => 'Templo de Asakusa',
                'descricao' => 'Um templo tradicional japonês, localizado em Tokyo.',
                'interesse' => 'Cultura',
                'trip_id' => Trip::where('cidade', 'Tokyo')->first()->id,
            ],
        ];

        // Insere as sugestões no banco de dados
        foreach ($sugests as $sugest) {
            Sugest::create($sugest);
        }
    }
}
