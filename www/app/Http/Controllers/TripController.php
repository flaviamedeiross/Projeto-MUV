<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Sugest;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TripController extends Controller {

    public function index() {
        // Lista viagens com sugestões
        return Inertia::render('ViagensDisponiveis', [
            'viagens' => Trip::with('sugests')->where('quantidade_disponivel', '>', 0)->get()
        ]);
    }

    public function disponiveis() {
        // API: Retorna viagens disponíveis
        return Trip::where('quantidade_disponivel', '>', 0)->get();
    }

    public function create()
    {
        return Inertia::render('CadastroViagem');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cidade' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'informacao' => 'required|string',
            'data_partida' => 'required|date|after:today',
            'data_chegada' => 'required|date|after:data_partida',
            'preco' => 'required|numeric|min:0',
            'quantidade_disponivel' => 'required|integer|min:0',
        ]);

        Trip::create([
            'cidade' => $request->cidade,
            'pais' => $request->pais,
            'informacao' => $request->informacao,
            'data_partida' => Carbon::parse($request->data_partida),
            'data_chegada' => Carbon::parse($request->data_chegada),
            'preco' => $request->preco,
            'quantidade_disponivel' => $request->quantidade_disponivel,
        ]);
        
        return redirect()->route('viagens.create')->with('success', 'Viagem cadastrada!');
    }
    
    public function comprar(Request $request, $id) {
        // Comprar viagem
        $trip = Trip::findOrFail($id);

        if ($trip->quantidade_disponivel > 0) {
            $trip->quantidade_disponivel -= 1;
            $trip->save();
            return response()->json(['mensagem' => 'Compra realizada com sucesso!', 'trip' => $trip]);
        }

        return response()->json(['mensagem' => 'Não há vagas disponíveis.'], 400);
    }

    public function cancelar(Request $request, $id) {
        // Cancelar viagem
        $trip = Trip::findOrFail($id);
        $trip->quantidade_disponivel += 1;
        $trip->save();
        return response()->json(['mensagem' => 'Viagem cancelada com sucesso!', 'trip' => $trip]);
    }

    public function filtrarPorInteresse(Request $request) {
        // Filtrar viagens por interesse
        $interesse = $request->input('interesse');
        return Trip::whereHas('sugests', function ($query) use ($interesse) {
            $query->where('interesse', $interesse);
        })->get();
    }
}
    


