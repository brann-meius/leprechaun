<?php

declare(strict_types=1);

namespace App\Traits\Models;

use App\Models\Scopes\FutureSoftDeletingScope;
use Illuminate\Database\Eloquent\SoftDeletes;

trait FutureSoftDeletes
{
    use SoftDeletes;

    public static function bootSoftDeletes(): void
    {
        static::addGlobalScope(new FutureSoftDeletingScope);
    }
}
