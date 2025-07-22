<?php

namespace App\Traits\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

trait Tokenable
{
    public function resolveRouteBindingQuery($query, $value, $field = null): ?Builder
    {
        if ($field !== null) {
            return parent::resolveRouteBindingQuery($query, $value, $field);
        }

        if (!Str::isUuid($value, Uuid::UUID_TYPE_UNIX_TIME)) {
            throw (new ModelNotFoundException)->setModel($this::class, [$value]);
        }

        return $query->whereHas('token', fn(Builder $builder) => $builder->where('id', '=', $value));
    }
}
