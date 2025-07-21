<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OutcomeController;
use App\Http\Controllers\TokenController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

Route::as('register.')
    ->group(function (): void {
        Route::get('/', [AuthController::class, 'create']);
        Route::post('/register', [AuthController::class, 'store'])->name('store');
    });

Route::prefix('{user}')
    ->group(function (): void {
        Route::get('/', function (User $user): Response {
            return Inertia::render('Luck', [
                'user' => $user->token,
            ]);
        })->name('home');

        Route::as('tokens.')
            ->prefix('tokens')
            ->group(function (): void {
                Route::post('/', [TokenController::class, 'store'])->name('store');
                Route::delete('/', [TokenController::class, 'destroy'])->name('destroy');
            });

        Route::as('outcomes.')
            ->prefix('outcomes')
            ->group(function (): void {
                Route::get('/', [OutcomeController::class, 'index'])->name('index');
            });
    });

