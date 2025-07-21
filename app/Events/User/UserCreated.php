<?php

declare(strict_types=1);

namespace App\Events\User;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;

class UserCreated
{
    use Dispatchable;

    public function __construct(
        readonly private(set) User $user
    ) {
        //
    }
}
