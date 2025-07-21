<?php

declare(strict_types=1);

namespace App\Pipelines\Outcome;

use Closure;

readonly class GenerateNumber
{
    private const int MIN = 1;

    private const int MAX = 1000;

    public function handle(array $payload, Closure $next)
    {
        $payload['number'] = rand($this::MIN, $this::MAX);

        return $next($payload);
    }
}
