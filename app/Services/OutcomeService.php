<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Outcome;
use App\Models\User;
use App\Pipelines\Outcome\CalculateAmount;
use App\Pipelines\Outcome\GenerateNumber;
use App\Repositories\OutcomeRepository;
use Illuminate\Pipeline\Pipeline;

readonly class OutcomeService
{
    public function __construct(
        private OutcomeRepository $outcomeRepository,
        private Pipeline $pipeline,
    ) {
        //
    }

    public function play(User $user): Outcome
    {
        $this->pipeline->send([
            'user_id' => $user->id,
        ])->through([
            GenerateNumber::class,
            CalculateAmount::class,
        ]);

        return $this->outcomeRepository->create($this->pipeline->thenReturn());
    }
}
