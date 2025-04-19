<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cliente; // Certifique-se de importar o modelo Paciente
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'nome' => 'Jose Camargo',
                'username' => 'jose',
                'password' => '123456',
                'cliente_id' => NULL,
                'role' => 'secretaria',
            ],
            [
                'nome' => 'Carla da Silva',
                'username' => 'carlasilva',
                'password' => '123456',
                'cliente_id' => NULL,
                'role' => 'secretaria',
            ],
            [
                'nome' => 'João da Silva',
                'username' => 'joaosilva',
                'password' => '123456',
                'role' => 'cliente',
                'cliente' => [
                    'nome' => 'João da Silva',
                    'cep' => '12345678',
                    'endereco' => 'Rua das Flores, 123',
                    'bairro' => 'Centro',
                    'cidade' => 'São Paulo',
                    'estado' => 'SP',
                    'telefone' => '11987654321',
                ],
            ],
            [
                'nome' => 'Maria Oliveira',
                'username' => 'mariaoliveira',
                'password' => '123456',
                'role' => 'cliente',
                'cliente' => [
                    'nome' => 'Maria Oliveira',
                    'cep' => '87654321',
                    'endereco' => 'Avenida Paulista, 456',
                    'bairro' => 'Bela Vista',
                    'cidade' => 'São Paulo',
                    'estado' => 'SP',
                    'telefone' => '11987654322',
                ],
            ],
            [
                'nome' => 'Carlos Pereira',
                'username' => 'carlospereira',
                'password' => '123456',
                'role' => 'cliente',
                'cliente' => [
                    'nome' => 'Carlos Pereira',
                    'cep' => '11223344',
                    'endereco' => 'Rua dos Pinheiros, 789',
                    'bairro' => 'Pinheiros',
                    'cidade' => 'São Paulo',
                    'estado' => 'SP',
                    'telefone' => '11987654323',
                ],
            ],
        ];

        foreach($users as $user) {
            if (isset($user['cliente'])) {
                // Cria o paciente
                $cliente = Cliente::create($user['cliente']);
                // Adiciona o ID do paciente ao usuário
                $user['cliente_id'] = $cliente->id;
            }

            // Cria o usuário
            $created_user = User::create([
                'nome' => $user['nome'],
                'username' => $user['username'],
                'password' => Hash::make($user['password']),
                'cliente_id' => $user['cliente_id'],
            ]);

            // Atribui o papel ao usuário
            $created_user->assignRole($user['role']);
        }
    }
}
