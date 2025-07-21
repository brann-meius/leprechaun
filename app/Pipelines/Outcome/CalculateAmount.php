<?php

declare(strict_types=1);

namespace App\Pipelines\Outcome;

use Closure;

readonly class CalculateAmount
{
    public function handle(array $payload, Closure $next)
    {
        $amount = $payload['number'] * $this->calculatePercent($payload['number']);
        $payload['amount'] = round($amount, 2);

        return $next($payload);
    }

    private function calculatePercent(int $number): float
    {
        if ($number % 2 === 0) {
            return 0;
        }

        return 0.1 + (intdiv($number, 300) * 0.2);
    }
}
