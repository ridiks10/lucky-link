<?php

namespace App\Features\LuckyGame\Http\Controllers;

use App\Features\AccessLink\Domain\Models\AccessLink;
use App\Features\LuckyGame\Actions\GetLastHistory;
use App\Features\LuckyGame\Actions\PlayLucky;
use App\Http\Controllers\Controller;

class LuckyController extends Controller
{
    public function play(AccessLink $accessLink, PlayLucky $action)
    {
        $playResult = $action->handle($accessLink);

        return redirect()->back()->with([
            'play_result' => $playResult,
        ]);
    }

    public function history(AccessLink $accessLink, GetLastHistory $action)
    {
        return redirect()->back()->with([
            'history' => $action->handle($accessLink),
        ]);
    }
}
