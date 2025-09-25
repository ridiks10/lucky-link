<?php

declare(strict_types=1);

namespace App\Features\Registration\Actions;

use App\Domain\Users\Models\User;
use App\Features\AccessLink\Actions\GenerateLink;
use App\Features\AccessLink\Domain\Models\AccessLink;

final class RegisterUser
{
    public function handle(string $username, string $phone_number): AccessLink
    {
        $user = User::create(compact('username', 'phone_number'));

        return app(GenerateLink::class)->handle($user);
    }
}
