<?php

declare(strict_types=1);

namespace App\Features\LuckyGame\Domain\Models;

use App\Casts\MoneyCast;
use App\Features\AccessLink\Domain\Models\AccessLink;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LuckyResult extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'access_link_id',
        'roll',
        'is_win',
        'payout',
        'percent',
    ];

    protected $casts = [
        'payout' => MoneyCast::class,
        'is_win' => 'boolean',
        'created_at' => 'datetime',
        'percent' => 'float',
    ];

    public function accessLink(): BelongsTo
    {
        return $this->belongsTo(AccessLink::class, 'access_link_id', 'id');
    }
}
