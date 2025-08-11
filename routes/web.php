<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CareersController;
use App\Http\Controllers\ConsumersController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/o-nas', [AboutController::class, 'index'])->name('about');
Route::get('/dokumenty', [DocumentsController::class, 'index'])->name('documents');
Route::get('/jidelniky', [MenuController::class, 'index'])->name('menu');
Route::get('/stravnici', [ConsumersController::class, 'index'])->name('consumers');
Route::get('/kariera', [CareersController::class, 'index'])->name('careers');
Route::get('/kontakt', [ContactController::class, 'index'])->name('contact');
