<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChannelController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ChannelController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/channels/create', [ChannelController::class, 'create'])
         ->name('channels.create');
    Route::post('/channels', [ChannelController::class, 'store'])
         ->name('channels.store');
    Route::get('/channels/{channel}', [ChannelController::class, 'show'])
         ->name('channels.show');
    Route::delete('/channels/{channel}', [ChannelController::class, 'destroy'])
         ->name('channels.destroy');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rotas de administração (apenas para admins)
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    });
});

require __DIR__.'/auth.php';