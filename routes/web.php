<?php

use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Guests\PageController as GuestsPageController;
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

Route::get('/', [GuestsPageController::class, 'home'])->name('guests.home');

// Routes Admin
Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [AdminPageController::class, 'dashboard'])->name('dashboard');

        // Route for trashed projects
        Route::get('projects/trashed', [ProjectsController::class, 'trashed'])->name('projects.trashed');

        // Routes for restoring and permanently deleting projects
        Route::post('projects/{slug}/restore', [ProjectsController::class, 'restore'])->name('projects.restore');
        Route::delete('projects/{slug}/forcedelete', [ProjectsController::class, 'forcedelete'])->name('projects.forcedelete');

        // Route for Projects
        Route::resource('projects', ProjectsController::class);

        // Routes for Types
        Route::resource('types', TypeController::class);

        // Routes for Technologies
        Route::resource('technologies', TechnologyController::class);
    });


Route::middleware('auth', 'verified')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

require __DIR__ . '/auth.php';
