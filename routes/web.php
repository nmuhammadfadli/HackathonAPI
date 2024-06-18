<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\Api\ResultApi;


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


//quizz
Route::get('/quizzes', [QuizController::class, 'index']);
Route::get('/quizzes/{id}', [QuizController::class, 'show']);



Route::get('/api/result', [ResultApi::class, 'index'])->name('result.index');
Route::get('/api/result/{result_id}', [ResultApi::class, 'show'])->name('result.show');
Route::get('/api/result/user/{user}', [ResultApi::class, 'showUser'])->name('result.showUser');
Route::post('/api/result/store', [ResultApi::class, 'store'])->name('result.store');
Route::put('/api/result/update/{result_id}', [ResultApi::class, 'update'])->name('result.update');
Route::delete('/api/result/delete/{result_id}', [ResultApi::class, 'delete'])->name('result.delete');


Route::get('/', function () {
    return view('welcome');
});
