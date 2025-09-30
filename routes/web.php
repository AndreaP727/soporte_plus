<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\ClienteTicketController;
use App\Http\Controllers\TecnicoTicketController;
use App\Http\Controllers\AdminTicketController;
use App\Http\Controllers\AdminUserController;

/*
|--------------------------------------------------------------------------
| Rutas Web
|--------------------------------------------------------------------------
*/

// Página de inicio
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Autenticación
Route::post('/register', [WebAuthController::class, 'register'])->name('register');
Route::get('/login', [WebAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [WebAuthController::class, 'loginUser'])->name('loginUser');
Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');

// -----------------------------
// CLIENTE
// -----------------------------
Route::prefix('cliente')->group(function () {
    Route::get('/tickets', [ClienteTicketController::class, 'index'])->name('cliente.tickets.index');
    Route::get('/tickets/create', [ClienteTicketController::class, 'create'])->name('cliente.tickets.create');
    Route::post('/tickets', [ClienteTicketController::class, 'store'])->name('cliente.tickets.store');
    Route::get('/tickets/{id}', [ClienteTicketController::class, 'show'])->name('cliente.tickets.show');
    Route::post('/tickets/{id}/comentar', [ClienteTicketController::class, 'comentar'])->name('cliente.tickets.comentar');
});

// -----------------------------
// TÉCNICO
// -----------------------------
Route::prefix('tecnico')->group(function () {
    Route::get('/tickets', [TecnicoTicketController::class, 'index'])->name('tecnico.tickets.index');
    Route::get('/tickets/{id}/editar', [TecnicoTicketController::class, 'edit'])->name('tecnico.tickets.edit');
    Route::post('/tickets/{id}/actualizar', [TecnicoTicketController::class, 'update'])->name('tecnico.tickets.update');
    Route::post('/tickets/{id}/comentar', [TecnicoTicketController::class, 'comentar'])->name('tecnico.tickets.comentar');
});

// -----------------------------
// ADMIN
// -----------------------------
Route::prefix('admin')->group(function () {
    // Gestión de tickets
    Route::get('/tickets', [AdminTicketController::class, 'index'])->name('admin.tickets.index');
    Route::get('/tickets/{id}/asignar', [AdminTicketController::class, 'asignarForm'])->name('admin.tickets.asignarForm');
    Route::post('/tickets/{id}/asignar', [AdminTicketController::class, 'asignar'])->name('admin.tickets.asignar');

    // ✅ Reportes (ahora incluye CSV, PDF y Excel)
    Route::get('/reportes/tickets.csv', [AdminTicketController::class, 'exportCsv'])->name('admin.reportes.csv');
    Route::get('/reportes/tickets.pdf', [AdminTicketController::class, 'exportPdf'])->name('admin.reportes.pdf');
    Route::get('/reportes/tickets.excel', [AdminTicketController::class, 'exportExcel'])->name('admin.reportes.excel');

    // ✅ Dashboard
    Route::get('/dashboard', [AdminTicketController::class, 'dashboard'])->name('admin.dashboard');

    // Gestión de usuarios
    Route::get('/usuarios', [AdminUserController::class, 'index'])->name('admin.usuarios.index');
    Route::post('/usuarios', [AdminUserController::class, 'store'])->name('admin.usuarios.store');
    Route::delete('/usuarios/{id}', [AdminUserController::class, 'destroy'])->name('admin.usuarios.destroy');
});