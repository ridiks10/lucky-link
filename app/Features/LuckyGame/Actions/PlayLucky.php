<?php

namespace App\Features\LuckyGame\Actions;

use App\Features\AccessLink\Domain\Models\AccessLink;
use App\Features\LuckyGame\Services\LuckyEngine;

final readonly class PlayLucky
{
    public function __construct(private LuckyEngine $engine) {}

    public function handle(AccessLink $link): array
    {
        $res = $this->engine->roll();

        $link->luckyResults()->create([
            'roll' => $res['roll'],
            'is_win' => $res['isWin'],
            'payout' => $res['payout'],
            'percent' => $res['percent'],
        ]);

        return [
            'roll' => $res['roll'],
            'result' => $res['isWin'] ? 'Win' : 'Lose',
            'payout' => number_format($res['payout'], 2, '.', ''),
        ];
    }
}
