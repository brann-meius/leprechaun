<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Token;
use App\Models\User;
use App\Repositories\TokenRepository;
use Carbon\Carbon;

readonly class TokenService
{
    public function __construct(
        private TokenRepository $tokenRepository,
    ) {
        //
    }

    public function generate(User $user): Token
    {
        return $this->tokenRepository->create([
            'user_id' => $user->id,
            'expired_at' => Carbon::now()
                ->addDays(Token::DURATION_DAYS),
        ]);
    }

    public function expireOtherTokens(User $user, ?Token $token = null): void
    {
        $this->tokenRepository->deleteByUser($user, $token);
    }
}
