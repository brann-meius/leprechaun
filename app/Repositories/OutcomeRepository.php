<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Outcome;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use JetBrains\PhpStorm\ArrayShape;

readonly class OutcomeRepository
{
    public function create(
        #[ArrayShape([
            'user_id' => 'int',
            'number' => 'int',
            'amount' => 'float',
        ])]
        array $attributes
    ): Outcome {
        return Outcome::query()
            ->create($attributes);
    }

    /**
     * @return Collection<Outcome>
     */
    public function receiveByUser(User $user, int $count = 3): Collection
    {
        return $user->outcomes()
            ->latest()
            ->take($count)
            ->get();
    }
}
