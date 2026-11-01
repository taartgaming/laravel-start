<?php

use App\Http\Controllers\AdminMovesetController;
use App\Http\Controllers\AdminSolveController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SolveController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MovesetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'user' => request()->user(),
        'tab' => request()->string('tab', 'overview')->toString(),
    ]);
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/timer', [SolveController::class, 'index'])->name('timer');
    Route::post('/solves', [SolveController::class, 'store'])->name('solves.store');

    Route::resource('/moveset', MovesetController::class)->only([
        'create', 'store', 'update', 'destroy',
    ])->middlewareFor(['create', 'store'], 'can:create-moveset');

    Route::get('/dashboard/solves/{solve}/edit', [AdminSolveController::class, 'edit'])
        ->middleware('can:access-admin')
        ->name('dashboard.solves.edit');
    Route::get('/dashboard/movesets/{moveset}/edit', [MovesetController::class, 'edit'])
        ->name('dashboard.movesets.edit');
});


Route::middleware(['auth', 'can:access-admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/solves', [AdminSolveController::class, 'index'])->name('solves.index');
    Route::patch('/solves/{solve}/accept', [AdminSolveController::class, 'accept'])->name('solves.accept');
    Route::put('/solves/{solve}', [AdminSolveController::class, 'update'])->name('solves.update');
    Route::delete('/solves/{solve}', [AdminSolveController::class, 'destroy'])->name('solves.destroy');
    Route::patch('/solves/{solve}/reject', [AdminSolveController::class, 'reject'])->name('solves.reject');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/demote', [AdminUserController::class, 'demote'])->name('users.demote');
    Route::patch('/users/{user}/unaccept-runs', [AdminUserController::class, 'unacceptRuns'])->name('users.unaccept-runs');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
});

Route::middleware(['auth', 'can:access-admin-or-creator'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/movesets', [AdminMovesetController::class, 'index'])->name('movesets.index');
    Route::post('/movesets/{moveset}/toggle', [AdminMovesetController::class, 'toggleStatus'])->name('movesets.toggle');
});
Route::view('/login', 'auth.login')->name('login');


Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::resource('/moveset', MovesetController::class)->only(['index', 'show']);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');


require __DIR__ . '/auth.php';
