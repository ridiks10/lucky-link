<?php

namespace App\Features\LuckyGame\Services;

final class LuckyEngine
{
    public function roll(): array
    {
        $roll = random_int(1, 1000);
        $isWin = $roll % 2 === 0;
        $percent = $this->rate($roll);
        $payout = $isWin ? $this->payout($roll, $percent) : 0.0;

        return compact('roll', 'isWin', 'payout', 'percent');
    }

    private function payout(int $roll, float $percent): float
    {
        return $roll * $percent;
    }

    private function rate(int $roll): float
    {
        return match (true) {
            $roll > 900 => 0.7,
            $roll > 600 => 0.5,
            $roll > 300 => 0.3,
            default => 0.1,
        };
    }
}
