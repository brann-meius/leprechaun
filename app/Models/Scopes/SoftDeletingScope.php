<?php

declare(strict_types=1);

namespace App\Models\Scopes;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope as BaseSoftDeletingScope;

class SoftDeletingScope extends BaseSoftDeletingScope
{
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where($model->getQualifiedDeletedAtColumn(), '>=', Carbon::now());
    }
}
