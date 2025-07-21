<?php

declare(strict_types=1);

namespace App\Traits\Models;

use App\Models\Scopes\SoftDeletingScope;
use Illuminate\Database\Eloquent\SoftDeletes as BaseSoftDeletes;

trait SoftDeletes
{
    use BaseSoftDeletes;

    public static function bootSoftDeletes(): void
    {
        static::addGlobalScope(new SoftDeletingScope);
    }
}
