<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Outcome;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Outcome $resource
 */
class OutcomeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'number' => $this->resource->number,
            'amount' => $this->resource->amount,
            'result' => $this->resource->amount === 0.0
                ? 'Lose'
                : 'Win',
        ];
    }
}
