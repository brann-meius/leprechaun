<?php

declare(strict_types=1);

namespace App\Models;

use App\Events\User\UserCreated;
use App\Traits\Models\Tokenable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $username
 * @property string $phone
 * @property Token $token
 * @property Collection<Token> $tokens
 * @property Collection<Outcome> $outcomes
*/
class User extends Model
{
    use Tokenable;

    public $timestamps = false;

    protected $guarded = [
        'id',
    ];

    protected $dispatchesEvents = [
        'created' => UserCreated::class,
    ];

    public function tokens(): HasMany
    {
        return $this->hasMany(Token::class);
    }

    public function token(): HasOne
    {
        return $this->tokens()
            ->latest('expired_at')
            ->one();
    }

    public function outcomes(): HasMany
    {
        return $this->hasMany(Outcome::class);
    }
}
