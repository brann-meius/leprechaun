<?php

declare(strict_types=1);

namespace App\Listeners\Token;

use App\Events\Token\TokenCreated;
use App\Services\TokenService;

readonly class RevokeOldToken
{
    public function __construct(
        private TokenService $tokenService
    ) {
        //
    }

    public function handle(TokenCreated $event): void
    {
        $token = $event->token;
        $user = $token->user;

        $this->tokenService->expireOtherTokens($user, $token);
    }
}
