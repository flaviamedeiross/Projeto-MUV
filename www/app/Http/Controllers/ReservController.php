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

        return Inertia::render('ReservIndex', [
            'reservas' => $reservas,
        ]);
    }

    public function create()
    {
        return Inertia::render('ReservasCriacao', [
            'clientes' => Cliente::all(),
            'trips' => Trip::where('quantidade_disponivel', '>', 0)->get(),
            'sugests' => Sugest::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'trip_id' => 'required|exists:trips,id',
            'tipo_exp' => 'required|string',
            'date_reserv' => 'required|date',
            'sugestao_ids' => 'array',
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
            'tipo_exp' => $request->tipo_exp,
            'trip_id' => $trip->id,
            'date_reserv' => $request->date_reserv,
        ]);

        $trip->decrement('quantidade_disponivel');

        if ($request->has('sugestao_ids')) {
            foreach ($request->sugestao_ids as $sugest_id) {
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
        $reserva = Reserv::with('sugests')->findOrFail($id);
        $sugestsIds = $reserva->sugests->pluck('id');

        return Inertia::render('Reservas/Edit', [
            'reserva' => $reserva,
            'clientes' => Cliente::all(),
            'trips' => Trip::all(),
            'sugests' => Sugest::all(),
            'sugestsSelecionadas' => $sugestsIds,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'tipo_exp' => 'required|string',
            'trip_id' => 'required|exists:trips,id',
            'date_reserv' => 'required|date',
            'sugestao_ids' => 'array',
        ]);

        $reserva = Reserv::findOrFail($id);

        $reserva->update([
            'cliente_id' => $request->cliente_id,
            'tipo_exp' => $request->tipo_exp,
            'trip_id' => $request->trip_id,
            'date_reserv' => $request->date_reserv,
        ]);

        ReservSugest::where('reserv_id', $reserva->id)->delete();

        if ($request->has('sugestao_ids')) {
            foreach ($request->sugestao_ids as $sugest_id) {
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
