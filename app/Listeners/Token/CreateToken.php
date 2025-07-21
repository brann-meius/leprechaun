<?php

declare(strict_types=1);

namespace App\Listeners\Token;

use App\Events\User\UserCreated;
use App\Services\TokenService;

readonly class CreateToken
{
    public function __construct(
        private TokenService $tokenService
    ) {
        //
    }

    public function handle(UserCreated $event): void
    {
        $user = $event->user;
        $user->token = $this->tokenService->generate($user);
    }
}
