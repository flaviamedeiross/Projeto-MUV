<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reserv;
use App\Models\Cliente;  
use App\Models\Trip;

class ReservsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $cliente = Cliente::first(); 
        $trip = Trip::first();

        // Dados das reservas para inserir no banco
        $reservas = [
            [
                'cliente_id' => $cliente->id,
                'tipo_exp' => 'Arte',
                'trip_id' => $trip->id,
                'date_reserv' => '2025-07-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insere as reservas no banco de dados
        foreach ($reservas as $reserva) {
            Reserv::create($reserva);
        }
    }
}
