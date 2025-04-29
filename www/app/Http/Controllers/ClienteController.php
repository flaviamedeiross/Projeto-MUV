<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;

use App\Http\Controllers\Controller;
use App\Models\Reserv;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{
    public function create()
    {
        return Inertia::render('Cliente');
    }

    public function dashboard(Cliente $cliente)
    {
        $cliente->load([
            'reservs.trip',
            'reservs.sugests'
        ]);

        return Inertia::render('/minhas-viagens', [
            'cliente' => $cliente,
            'reservas' => $cliente->reservs
        ]);
    }

    public function store(Request $request)
    {
        $mensagens = [
            'nome.required' => 'O nome é obrigatório.',
            'cep.required' => 'O CEP é obrigatório.',
            'cep.size' => 'O CEP deve ter 8 caracteres.',
            'endereco.required' => 'O endereço é obrigatório.',
            'bairro.required' => 'O bairro é obrigatório.',
            'cidade.required' => 'A cidade é obrigatória.',
            'estado.required' => 'O estado é obrigatório.',
            'telefone.required' => 'O telefone é obrigatório.',
            'telefone.max' => 'O telefone deve ter no máximo 15 caracteres.',
            'username.required' => 'O username é obrigatório.',
            'username.unique' => 'Este username já está em uso.',
            'password.required' => 'A password é obrigatória.',
            'password.min' => 'A password deve ter pelo menos 6 caracteres.',
        ];

        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'cep' => 'required|string|size:8',
            'endereco' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'telefone' => 'required|string|max:15',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|min:6',
        ], $mensagens);

        DB::beginTransaction();
        try {
            $cliente = Cliente::create($request->only([
                'nome', 'cep', 'endereco', 'bairro', 'cidade', 'estado', 'telefone'
            ]));

            $user = User::create([
                'nome' => $request->nome,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'cliente_id' => $cliente->id,
            ]);

            $user->assignRole('cliente');

            event(new Registered($user));
            
            DB::commit();
            
            return response()->json(['message' => 'Cliente cadastrado com sucesso!', 'cliente' => $cliente]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao cadastrar cliente.'], 500);
        }
    }

    public function storeind(Request $request)
    {
        $mensagens = [
            'nome.required' => 'O nome é obrigatório.',
            'cep.required' => 'O CEP é obrigatório.',
            'cep.size' => 'O CEP deve ter 8 caracteres.',
            'endereco.required' => 'O endereço é obrigatório.',
            'bairro.required' => 'O bairro é obrigatório.',
            'cidade.required' => 'A cidade é obrigatória.',
            'estado.required' => 'O estado é obrigatório.',
            'telefone.required' => 'O telefone é obrigatório.',
            'telefone.max' => 'O telefone deve ter no máximo 15 caracteres.',
            'username.required' => 'O username é obrigatório.',
            'username.unique' => 'Este username já está em uso.',
            'password.required' => 'A password é obrigatória.',
            'password.min' => 'A password deve ter pelo menos 6 caracteres.',
        ];

        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'cep' => 'required|string|size:8',
            'endereco' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'telefone' => 'required|string|max:15',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|min:6',
        ], $mensagens);

        DB::beginTransaction();
        try {
            $cliente = Cliente::create($request->only([
                'nome', 'cep', 'endereco', 'bairro', 'cidade', 'estado', 'telefone'
            ]));

            $user = User::create([
                'nome' => $request->nome,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'cliente_id' => $cliente->id,
            ]);

            $user->assignRole('cliente');

            event(new Registered($user));

            DB::commit();
            return Inertia::location(route('clientesind'));
        } catch (\Exception $e) {
            DB::rollBack();
            return Inertia::render('ErrorPage', [
                'message' => 'Erro ao cadastrar cliente.',
            ])->withStatus(500);
        }
    }
    public function index()
    {
        return Cliente::all();
    }

    public function update(Request $request, $id)
    {
        $mensagens = [
            'nome.required' => 'O nome é obrigatório.',
            'cep.required' => 'O cep é obrigatório.',
            'telefone.required' => 'O telefone é obrigatório.',
            'telefone.max' => 'O telefone deve ter no máximo 15 caracteres.'
        ];

        $request->validate([
            'nome' => 'required|string|max:255',
            'cep' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'telefone' => 'required|string|max:15',

        ], $mensagens);

        $cliente = Cliente::findOrFail($id);
        $cliente->nome = $request->nome;
        $cliente->cep = $request->cep;
        $cliente->endereco = $request->endereco;
        $cliente->bairro = $request->bairro;
        $cliente->cidade = $request->cidade;
        $cliente->estado = $request->estado;
        $cliente->telefone = $request->telefone;
        $cliente->save();

        return response()->json(['message' => 'Cliente atualizado com sucesso!']);
    }

    public function verificarTrips()
    {
        $user = Auth::user();
    
        // Verifica se o cliente tem animais
        $temTrips = $user->cliente->trip()->exists();
    
        return response()->json(['temTrips' => $temTrips]);
    }
    
    public function minhasViagens()
    {
        $user = Auth::user();
        // Busca o cliente vinculado ao usuário logado
        $cliente = $user->cliente;

        // Carrega as reservas com as viagens associadas
        $reservas = Reserv::with('trip')
                    ->where('cliente_id', $cliente->id)
                    ->get();

        return Inertia::render('MinhasViagens', [
            'reservas' => $reservas,
        ]);
    }


}