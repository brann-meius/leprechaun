<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Token;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use JetBrains\PhpStorm\ArrayShape;

readonly class TokenRepository
{
    public function create(
        #[ArrayShape([
            'user_id' => 'int',
            'expired_at' => Carbon::class,
        ])]
        array $attributes
    ): Token {
        return Token::query()
            ->create($attributes);
    }

    public function deleteByUser(User $user, ?Token $except = null): void
    {
        $user->tokens()
            ->when($except, fn(Builder $builder): Builder => $builder->whereKeyNot($except))
            ->delete();
    }
}
