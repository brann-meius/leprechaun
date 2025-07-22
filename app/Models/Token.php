<?php

declare(strict_types=1);

namespace App\Models;

use App\Events\Token\TokenCreated;
use App\Traits\Models\FutureSoftDeletes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property int $user_id
 * @property Carbon $expired_at
 * @property User $user
 */
class Token extends Model
{
    use FutureSoftDeletes;
    use HasUuids;

    public const int DURATION_DAYS = 7;

    public const string DELETED_AT = 'expired_at';

    public $timestamps = false;

    protected $guarded = [
        'id',
    ];

    protected $dispatchesEvents = [
        'created' => TokenCreated::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'expired_at' => 'datetime',
        ];
    }
}
