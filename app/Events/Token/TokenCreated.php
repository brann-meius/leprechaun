<?php

declare(strict_types=1);

namespace App\Events\Token;

use App\Models\Token;
use Illuminate\Foundation\Events\Dispatchable;

class TokenCreated
{
    use Dispatchable;

    public function __construct(
        readonly private(set) Token $token
    ) {
        //
    }
}
