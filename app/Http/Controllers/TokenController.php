<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\TokenService;
use Illuminate\Http\RedirectResponse;

class TokenController extends Controller
{
    public function __construct(
        private readonly TokenService $tokenService
    ) {
        //
    }

    public function store(User $user): RedirectResponse
    {
        $token = $this->tokenService->generate($user);

        return to_route('home', ['user' => $token]);
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->tokenService->expireOtherTokens($user);

        return to_route('register.');
    }
}
