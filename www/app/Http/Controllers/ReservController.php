<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Trip;
use App\Models\Sugest;
use App\Models\Reserv;
use App\Models\ReservSugest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class ReservController extends Controller
{
    public function index()
    {
        $reservas = Reserv::with(['cliente', 'trip', 'sugests'])->get();

        return Inertia::render('Reservas/Index', ['reservas' => $reservas,]);
    }
    public function create()
    {
        return Inertia::render('Reservas/Create', [
            'clientes' => Cliente::all(),
            'viagens' => Trip::where('quantidade_disponivel', '>', 0)->get(),
            'sugestoes' => Sugest::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'trip_id' => 'required|exists:trips,id',
            'data_reserva' => 'required|date',
            'sugests_ids' => 'array',
        ]);

        $cliente = Cliente::findOrFail($request->cliente_id);
        $trip = Trip::findOrFail($request->trip_id);

        if ($trip->quantidade_disponivel < 1) {
            return back()->withErrors(['trip_id' => 'Viagem esgotada']);
        }

        if (Reserv::where('cliente_id', $cliente->id)->where('trip_id', $trip->id)->exists()) {
            return back()->withErrors(['trip_id' => 'Cliente já reservou esta viagem']);
        }

        $reserva = Reserv::create([
            'cliente_id' => $cliente->id,
            'trip_id' => $trip->id,
            'date_reserv' => $request->data_reserva,
        ]);

        $trip->decrement('quantidade_disponivel');

        if ($request->has('sugests_ids')) {
            foreach ($request->sugests_ids as $sugest_id) {
                ReservSugest::create([
                    'reserv_id' => $reserva->id,
                    'sugest_id' => $sugest_id,
                ]);
            }
        }

        return redirect()->route('reservas.index')->with('success', 'Reserva realizada com sucesso.');
    }

    public function edit($id)
    {
        $reserva = Reserv::with('sugestoes')->findOrFail($id);
        $sugestsIds = $reserva->sugestoes->pluck('id');

        return Inertia::render('Reservas/Edit', [
            'reserva' => $reserva,
            'clientes' => Cliente::all(),
            'viagens' => Trip::all(),
            'sugestoes' => Sugest::all(),
            'sugestsSelecionadas' => $sugestsIds,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'trip_id' => 'required|exists:trips,id',
            'data_reserva' => 'required|date',
            'sugests_ids' => 'array',
        ]);

        $reserva = Reserv::findOrFail($id);

        $reserva->update([
            'cliente_id' => $request->cliente_id,
            'trip_id' => $request->trip_id,
            'date_reserv' => $request->data_reserva,
        ]);

        ReservSugest::where('reserv_id', $reserva->id)->delete();
        if ($request->has('sugests_ids')) {
            foreach ($request->sugests_ids as $sugest_id) {
                ReservSugest::create([
                    'reserv_id' => $reserva->id,
                    'sugest_id' => $sugest_id,
                ]);
            }
        }

        return redirect()->route('reservas.index')->with('success', 'Reserva atualizada com sucesso.');
    }

    public function destroy($id)
    {
        $reserva = Reserv::findOrFail($id);
        $reserva->trip->increment('quantidade_disponivel');

        ReservSugest::where('reserv_id', $reserva->id)->delete();
        $reserva->delete();

        return redirect()->route('reservas.index')->with('success', 'Reserva cancelada com sucesso.');
    }
}
