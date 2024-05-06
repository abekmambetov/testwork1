<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApiController;

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


Route::get('/', [HomeController::class, 'index']);
Route::get('/images', [HomeController::class, 'showImages']);
Route::post('/saveImages', [HomeController::class, 'saveImages'])->name('save-images');
Route::get('/getFile', [HomeController::class, 'getFile']);

/* Get images api */
Route::get('/api/getImages', [ApiController::class, 'getImages']);
Route::get('/api/getImage', [ApiController::class, 'getImage']);


