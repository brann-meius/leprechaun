<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use JetBrains\PhpStorm\ArrayShape;

readonly class UserRepository
{
    public function create(
        #[ArrayShape([
            'username' => 'string',
            'phone' => 'string',
        ])]
        array $attributes
    ): User {
        return User::query()
            ->create($attributes);
    }
}
