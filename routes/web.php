<?php

use App\Http\Controllers\ModuleController;
use App\Livewire\ModuleComponent;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// if utilize a component to the route
// Route::get('modules', ModuleComponent::class)
//     ->name('modules')
//     ->middleware(['auth', 'verified']);

Route::get('modules', [ModuleController::class, 'index'])
    ->name('modules')
    ->middleware(['auth', 'verified']);

Route::get('module/{module}', [ModuleController::class, 'view'])
    ->name('module.view')
    ->middleware(['auth', 'verified']);

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
