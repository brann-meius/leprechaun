<?php

declare(strict_types=1);

use App\Http\Controllers\OutcomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('users/{user}')
    ->group(function (): void {
        Route::prefix('outcomes')
            ->group(function (): void {
                Route::post('/', [OutcomeController::class, 'store']);
            });
    });
