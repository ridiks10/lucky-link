<?php

declare(strict_types=1);

namespace App\Features\AccessLink\Actions;

use App\Domain\Users\Models\User;
use App\Features\AccessLink\Domain\Models\AccessLink;

final class GenerateLink
{
    public function handle(User $user): AccessLink
    {
        return $user->accessLink()->create([
            'is_active' => true,
            'expires_at' => now()->addDays(AccessLink::EXPIRES_DAYS),
        ]);
    }
}
