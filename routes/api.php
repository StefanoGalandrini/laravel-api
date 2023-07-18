<?php

use App\Http\Controllers\Api\ProjectsController;
use App\Http\Controllers\Api\TechnologyController;
use App\Http\Controllers\Api\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('projects', [ProjectsController::class, 'index'])->name('api.projects.index');
Route::get('projects/random', [ProjectsController::class, 'random'])->name('api.projects.random');
Route::get('projects/{project}', [ProjectsController::class, 'show'])->name('api.projects.show');

// Route for Type search
Route::get('types', [TypeController::class, 'index'])->name('api.types.index');

// Route for Technology search
Route::get('technologies', [TechnologyController::class, 'index'])->name('api.technologies.index');
