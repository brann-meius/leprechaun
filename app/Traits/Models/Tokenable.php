<?php

namespace App\Traits\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait Tokenable
{
    public function resolveRouteBindingQuery($query, $value, $field = null): Builder
    {
        if ($field !== null) {
            return parent::resolveRouteBindingQuery($query, $value, $field);
        }

        return $query->whereHas('token', fn(Builder $builder) => $builder->where('id', '=', $value));
    }
}
