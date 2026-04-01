<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::resource('tasks', TodoController::class);