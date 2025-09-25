<?php

use App\Features\AccessLink\Http\Controllers\AccessPageController;
use App\Features\LuckyGame\Http\Controllers\LuckyController;
use App\Features\Registration\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/l/{access_link:link_id}', [AccessPageController::class, 'index'])->name('access.index');
Route::get('/l/{access_link:link_id}/regenerate', [AccessPageController::class, 'regenerate'])->name('link.regenerate');
Route::get('/l/{access_link:link_id}/deactivate', [AccessPageController::class, 'deactivate'])->name('link.deactivate');
Route::post('/l/{access_link:link_id}/lucky', [LuckyController::class, 'play'])->name('lucky.play');
Route::post('/l/{access_link:link_id}/history', [LuckyController::class, 'history'])->name('lucky.history');
