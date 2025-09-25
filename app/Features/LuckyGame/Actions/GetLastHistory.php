<?php

declare(strict_types=1);

namespace App\Features\LuckyGame\Actions;

use App\Features\AccessLink\Domain\Models\AccessLink;
use Illuminate\Support\Collection;

final class GetLastHistory
{
    public function handle(AccessLink $link, int $limit = 3): Collection
    {
        $history = $link->luckyResults()
            ->latest()->limit($limit)
            ->get(['roll', 'is_win', 'payout', 'created_at']);

        return $history->map(fn ($l) => [
            'roll' => $l->roll,
            'result' => $l->is_win ? 'Win' : 'Lose',
            'payout' => $l->payout,
            'created_at' => $l->created_at->toDateTimeString(),
        ]);
    }
}
