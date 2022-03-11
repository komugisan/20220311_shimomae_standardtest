<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactManagement;

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

Route::get('/', [ContactController::class, 'index'])->name('contact');
Route::post('/', [ContactController::class, 'fixMessage']);
Route::post('/message-check', [ContactController::class, 'postMessage']);
Route::get('/message-check', [ContactController::class, 'checkMessage']);
Route::post('/message-send', [ContactController::class, 'sendMessage']);
Route::get('/message-management', [ContactManagement::class, 'index']);
Route::post('/message-management', [ContactManagement::class, 'check']);
Route::get('/message-search', [ContactManagement::class, 'check']);

Route::view('/message-send', 'message-send');