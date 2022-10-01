<?php

use App\Http\Controllers\PinController;
use App\Models\Pin;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'pins' => Pin::all()->map( function ($pin) {
            return [
                'id' => $pin->id,
                'title' => $pin->title,
                'description' => $pin->description,
                'user_name' => $pin->User->name
            ];
        })
    ]);
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/pins', function () {
        return Inertia::render('Pins');
    })->name('pins');

    Route::post('/pins/create', [PinController::class, 'create'])->name('pin.create');
    Route::post('/pins/store', [PinController::class, 'store'])->name('pin.create');
    Route::delete('/pins/destroy/{id}', [PinController::class, 'destroy'])->name('pin.destroy');
});
