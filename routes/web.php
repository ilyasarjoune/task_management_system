<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\taskController;
use App\Http\Controllers\ProfileController;

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
Route::resource('task' ,taskController::class);
Route::get('tasks/getTasks', [taskController::class, 'getTasks'])->name('tasks.getTasks');
Route::post('task/{task}/assign', [taskController::class, 'assignUser'])->name('task.assign');


Route::put('/task/{task}', [TaskController::class, 'update'])->name('task.update');

require __DIR__.'/auth.php';
