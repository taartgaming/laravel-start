<?php

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
});


Route::middleware('auth')->group(function () {
    Route::get('/timer', [SolveController::class, 'index'])->name('timer');
    Route::post('/solves', [SolveController::class, 'store'])->name('solves.store');
});
Route::view('/login', 'auth.login')->name('login');


Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::resource('/moveset', MovesetController::class);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');


Route::get('/idea/{id}', function (int $id) {
    return view('idea', [
        'id' => $id
    ]);
})->name('idea');

Route::get('/id', function () {
    return redirect()->route('idea', ['id' => 2]);
});;


require __DIR__ . '/auth.php';
