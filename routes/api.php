<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->controller(\App\Http\Controllers\TodoController::class)->prefix('todo-list')->group(function () {
    Route::post('add', 'store');
    Route::get('list', 'list');
    Route::get('show/{id}', 'show');
    Route::put('update/{id}', 'update');

    Route::patch('toggle-done/{id}', 'toggleDone');

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
