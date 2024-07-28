<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('dashboard');
    }
    return view('auth.login');
});

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('dashboard');
    }
    return view('auth.login');
});
Route::get('/register', function () {
    if (Auth::check()) {
        return redirect('dashboard');
    }
    return view('auth.register');
});
Route::get('/forgot-password', function () {
    if (Auth::check()) {
        return redirect('dashboard');
    }
    return view('auth.forgot-password');
});

Route::get('/dashboard', function () {
    $userId = Auth::id();
    $userName = auth()->user()->name;
    $tasks = Task::where('user_id', $userId)->get();
    return view('dashboard',compact('tasks','userName'));
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//Task Controller
Route::middleware('auth')->group(function () {
    Route::get('/add-task', [TaskController::class, 'AddTask']);
    Route::post('/tasks/store', [TaskController::class, 'store'])->name('task.store');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::get('/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::post('/task/update', [TaskController::class, 'update'])->name('task.update');
    });
require __DIR__.'/auth.php';
