<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/{vue_capture?}', [HomeController::class, 'index'])
    ->where('vue_capture', '[\/\w\.-]*')
    ->name('login');


