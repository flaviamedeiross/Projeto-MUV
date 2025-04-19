<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ReservController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\SugestController;
use App\Http\Controllers\NotificacaoController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Rota para Login
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//Rota para o Home do User
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'canRegister' => Route::has('register'),    
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';

//Rota para vue Cadastro de Paciente
Route::get('/cadastrocliente', function () {
    return Inertia::render('Cliente');
})->name('cadastrocliente');

// Rota para cadastro independente
Route::get('/cadastro-cliente', function () {
    return Inertia::render('ClienteIndependente');
})->name('cadastro.cliente');

Route::get('/reservas', [ReservController::class, 'index'])->name('reservas.index');
Route::get('/reservas/create', [ReservController::class, 'create'])->name('reservas.create');
Route::post('/reservas', [ReservController::class, 'store'])->name('reservas.store');
Route::get('/reservas/{reserv}/edit', [ReservController::class, 'edit'])->name('reservas.edit');
Route::put('/reservas/{reserv}', [ReservController::class, 'update'])->name('reservas.update');
Route::delete('/reservas/{reserv}', [ReservController::class, 'destroy'])->name('reservas.destroy');

Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/minhas-viagens', [ClienteController::class, 'minhasViagens'])->name('cliente.viagens');
    Route::get('/viagens-futuras', [ClienteController::class, 'viagensFuturas'])->name('cliente.futuras');
    Route::get('/editar-dados', [ClienteController::class, 'edit'])->name('cliente.edit');
    Route::post('/editar-dados', [ClienteController::class, 'update'])->name('cliente.update');
});

Route::get('/cadastrarviagem', [TripController::class, 'create'])->name('viagens.create');
Route::post('/cadastrarviagem', [TripController::class, 'store'])->name('viagens.store');

Route::get('/cadastrarsugests', [SugestController::class, 'create'])->name('sugests.create');
Route::post('/cadastrarsugests', [SugestController::class, 'store'])->name('sugests.store');

//Rota para Registro de Secretaria e Veterinario
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Rota para cadastro de paciente (tutor) independentemente
Route::get('clientesind', [ClienteController::class, 'createind'])->name('clientesind.create');
Route::post('/clientesind', [ClienteController::class, 'storeind'])->name('clientesind.store');
Route::get('clientes', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');

Route::get('/users', [UserController::class, 'index']);

// Rota para exibir formulário de cadastro de paciente
Route::get('/clintes/cadastrar', function () {
    return view('Cliente'); // Arquivo Vue onde está o formulário de cadastro de paciente
})->name('clientes.form');
