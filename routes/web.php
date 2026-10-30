<?php

use App\Http\Controllers\AdminMovesetController;
use App\Http\Controllers\AdminSolveController;
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
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/timer', [SolveController::class, 'index'])->name('timer');
    Route::post('/solves', [SolveController::class, 'store'])->name('solves.store');
});


Route::middleware(['auth', 'can:access-admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/solves', [AdminSolveController::class, 'index'])->name('solves.index');
    Route::patch('/solves/{solve}/accept', [AdminSolveController::class, 'accept'])->name('solves.accept');
    Route::get('/solves/{solve}/edit', [AdminSolveController::class, 'edit'])->name('solves.edit'); // Nieuw
    Route::put('/solves/{solve}', [AdminSolveController::class, 'update'])->name('solves.update');
    Route::delete('/solves/{solve}', [AdminSolveController::class, 'destroy'])->name('solves.destroy');
    Route::get('/movesets', [AdminMovesetController::class, 'index'])->name('movesets.index');
    Route::post('/movesets/{moveset}/toggle', [AdminMovesetController::class, 'toggleStatus'])->name('movesets.toggle');

});
Route::view('/login', 'auth.login')->name('login');


Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::resource('/moveset', MovesetController::class);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');


require __DIR__ . '/auth.php';
