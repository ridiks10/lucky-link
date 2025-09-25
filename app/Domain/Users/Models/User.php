<?php

declare(strict_types=1);

namespace App\Domain\Users\Models;

use App\Features\AccessLink\Domain\Models\AccessLink;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    protected $fillable = [
        'username',
        'phone_number',
    ];

    public function accessLink(): HasOne
    {
        return $this->hasOne(AccessLink::class);
    }
}
