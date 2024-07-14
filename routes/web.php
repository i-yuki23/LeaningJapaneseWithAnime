<?php

use App\Http\Controllers\YoutubeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [YoutubeController::class, 'index'])->name('youtube.index');
Route::post('/search', [YoutubeController::class, 'redirectToSearch'])->name('youtube.search.post');
Route::get('/search/{keyword}', [YoutubeController::class, 'searchVideosByKeyword'])->name('youtube.search');