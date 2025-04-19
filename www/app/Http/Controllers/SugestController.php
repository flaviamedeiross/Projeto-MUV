<?php

namespace App\Http\Controllers;
use App\Models\Sugest;
use App\Models\Trip;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SugestController extends Controller
{
    public function index($tripId)
    {
        $sugestoes = Sugest::where('trip_id', $tripId)->get();
        return response()->json($sugestoes);
    }

    public function create()
    {
        $viagens = Trip::all();
        return Inertia::render('CadastroSugestoes', [
            'viagens' => $viagens
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'interesse' => 'required|string',
            'trip_id' => 'required|exists:trips,id',
        ]);

        $sugestao = Sugest::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'interesse' => $request->interesse,
            'trip_id' => $request->trip_id,
        ]);
        return redirect()->route('sugests.create')->with('success', 'Sugestão criada com sucesso!');
    }

    public function viagensPorInteresse($interesse)
    {
        $viagens = Trip::where('quantidade_disponivel', '>', 0)
            ->with(['sugestoes' => function ($query) use ($interesse) {
                $query->select('id', 'trip_id', 'interesse');
            }])
            ->get()
            ->map(function ($viagem) use ($interesse) {
                $viagem->tem_interesse = $viagem->sugestoes->contains('interesse', $interesse);
                unset($viagem->sugestoes);
                return $viagem;
            });

        return response()->json($viagens);
    }
}
