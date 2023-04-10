<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public Routes


// Route::post('/note',function () {
//     return Note::create([
//         'title' => 'That\'s pretty good',
//         'content' => 'Something Somthing',
//         'user_id' => 1
//     ]);
// });

Route::post('/register',[AuthController::class,'register']);

Route::post('/login',[AuthController::class,'login']);

Route::get('/test',[AuthController::class,'test']);

// Route::get('/note/search/{title}',[NoteController::class,'search']);

// Protected Routes

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('/note',NoteController::class);
    Route::get('/note/search/{title}',[NoteController::class,'search']);
    Route::post('/logout',[AuthController::class,'logout']);
});
