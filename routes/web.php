<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [TaskController::class, 'index'])->name('index');
Route::post('/Task/Store', [TaskController::class, 'store'])->name('store');
Route::get('/api/get/tasks', [TaskController::class, 'getTask'])->name('getTask');
Route::delete('/api/delete/task/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::put('/api/put/task/{id}', [TaskController::class, 'edit'])->name('tasks.edit');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
