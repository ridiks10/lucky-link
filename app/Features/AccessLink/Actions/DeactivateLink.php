<?php

declare(strict_types=1);

namespace App\Features\AccessLink\Actions;

use App\Features\AccessLink\Domain\Models\AccessLink;

final class DeactivateLink
{
    public function handle(AccessLink $link): void
    {
        $link->update(['is_active' => false]);
    }
}
