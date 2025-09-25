<?php

declare(strict_types=1);

namespace App\Features\AccessLink\Domain\Models;

use App\Domain\Users\Models\User;
use App\Features\LuckyGame\Domain\Models\LuckyResult;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class AccessLink extends Model
{
    use HasUuids;

    const EXPIRES_DAYS = 7;

    protected $fillable = [
        'user_id',
        'expires_at',
        'link_id',
        'is_active',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function luckyResults(): HasMany
    {
        return $this->hasMany(LuckyResult::class, 'access_link_id', 'id');
    }

    #[Scope]
    public function active(Builder $query): void
    {
        $query
            ->where('is_active', true)
            ->where('expires_at', '>', now());
    }

    public function url(): string
    {
        return route('access.index', $this->link_id);
    }

    public function expiresIn(): string
    {
        return $this->expires_at->diffForHumans(now(), [
             'parts' => 1,
             'short' => false,
             'syntax' => CarbonInterface::DIFF_ABSOLUTE,
         ]);
    }

    public function uniqueIds(): array
    {
        return ['link_id'];
    }

    public function newUniqueId(): string
    {
        return Str::orderedUuid()->toString();
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return match ($field) {
            'link_id' => $this->where('link_id', $value)->active()->firstOrFail(),
            default => parent::resolveRouteBinding($value, $field),
        };
    }
}
