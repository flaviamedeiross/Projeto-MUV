<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Trip;
use App\Models\Sugest;
use Inertia\Inertia;

class CompraController extends Controller
{
    public function comprarViagem(Request $request)
    {
        $cliente = Cliente::findOrFail($request->cliente_id);
        $trip = Trip::findOrFail($request->trip_id);

        // Verifica se ainda há disponibilidade
        if ($trip->quantidade_disponivel < 1) {
            return response()->json(['message' => 'Viagem esgotada'], Response::HTTP_CONFLICT);
        }

        // Verifica se já comprou
        if ($cliente->trips()->where('trip_id', $trip->id)->exists()) {
            return response()->json(['message' => 'Cliente já comprou essa viagem'], Response::HTTP_CONFLICT);
        }

        // Associa a viagem
        $cliente->trips()->attach($trip->id);

        // Decrementa quantidade disponível
        $trip->decrement('quantidade_disponivel');

        // Associa sugestões
        if ($request->has('sugestao_ids')) {
            $cliente->sugestoes()->syncWithoutDetaching($request->sugestao_ids);
        }

        return response()->json(['message' => 'Viagem comprada com sucesso']);
    }

    public function cancelarCompra(Request $request)
    {
        $cliente = Cliente::findOrFail($request->cliente_id);
        $trip = Trip::findOrFail($request->trip_id);

        if (!$cliente->trips()->where('trip_id', $trip->id)->exists()) {
            return response()->json(['message' => 'Cliente não possui essa viagem'], Response::HTTP_BAD_REQUEST);
        }

        $cliente->trips()->detach($trip->id);
        $trip->increment('quantidade_disponivel');

        $sugestoesIds = $trip->sugestoes()->pluck('id');
        $cliente->sugestoes()->detach($sugestoesIds);

        return response()->json(['message' => 'Compra cancelada com sucesso']);
    }

    public function viagensDisponiveis()
    {
        $viagens = Trip::where('quantidade_disponivel', '>', 0)->get();
        return response()->json($viagens);
    }

    public function viagensPorInteresse($interesse)
    {
        $viagens = Trip::where('quantidade_disponivel', '>', 0)
            ->whereHas('sugestoes', function ($query) use ($interesse) {
                $query->where('interesse', $interesse);
            })->get();

        return response()->json($viagens);
    }

    public function minhasViagens(Request $request)
    {
        $cliente = Cliente::with('trips')->findOrFail($request->cliente_id);
        return response()->json($cliente->trips);
    }
    
}
