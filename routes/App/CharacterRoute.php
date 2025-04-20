<?php

use App\Http\Controllers\Character\CharacterController;
use Illuminate\Support\Facades\Route;

Route::prefix('character')->group(function () {
    Route::get('/getAll', [CharacterController::class, 'getAll'])->name('Character.getAll');
    Route::post('/store', [CharacterController::class, 'store'])->name('Character.store');
});
