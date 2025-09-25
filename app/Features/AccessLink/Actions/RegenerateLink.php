<?php

declare(strict_types=1);

namespace App\Features\AccessLink\Actions;

use App\Features\AccessLink\Domain\Models\AccessLink;

final class RegenerateLink
{
    public function handle(AccessLink $link): AccessLink
    {
        $link->update([
            'link_id' => $link->newUniqueId(),
            'expires_at' => now()->addDays(AccessLink::EXPIRES_DAYS),
        ]);

        return $link;
    }
}
