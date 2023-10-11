<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('guests.welcome');
});

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Ragruppiamo le Route

Route::middleware('auth','verified')
    ->prefix('admin')
    ->name('admin.')
    ->group(function(){
        //Utilizziamo resource per assegnare in automatico le rotte
        Route::resource("projects", ProjectController::class);  

        /////////////////////////// ALTRIMENTI ///////////////////
        
    // //Route per il Create
    // Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    // Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    
    // //Route per il Read
    // Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    // Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    
    // //Route per l'Edit
    // Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    // //Route per l'Update
    // Route::put('/{project}', [ProjectController::class, 'update'])->name('projects.update');
    
    // //Route per il Delete
    // Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    
    
});
    
    
    
    
    
    Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
});

require __DIR__.'/auth.php';
