<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\BigFiveController;

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
    return view('welcome');
});



Route::get('/chat', function () {
    return view('chat');
})->name('chat.form');

Route::post('/chat', [ChatController::class, 'chat'])->name('chat');

Route::get('/big-five', [BigFiveController::class,'index']);
Route::post('/big-five/results', [ChatController::class,'results']);
