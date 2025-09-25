<?php

namespace App\Features\AccessLink\Http\Controllers;

use App\Features\AccessLink\Actions\DeactivateLink;
use App\Features\AccessLink\Actions\RegenerateLink;
use App\Features\AccessLink\Domain\Models\AccessLink;

class AccessPageController
{
    public function index(AccessLink $accessLink)
    {
        $accessLink->load('user:id,username,phone_number');

        return view('index', [
            'user' => $accessLink->user,
            'link' => $accessLink,
        ]);
    }

    public function regenerate(AccessLink $accessLink, RegenerateLink $action)
    {
        try {
            $link = \DB::transaction(function () use ($accessLink, $action) {
                return $action->handle($accessLink);
            }, 3);
        } catch (\Throwable $e) {
            report($e);

            return redirect()->back()->withErrors(['error' => 'An error occurred while regenerating the link. Please try again.']);
        }

        return redirect($link->url())->with('success', 'Link regenerated successfully.');
    }

    public function deactivate(AccessLink $accessLink, DeactivateLink $action)
    {
        $action->handle($accessLink);

        return redirect()->route('register.index');
    }
}
