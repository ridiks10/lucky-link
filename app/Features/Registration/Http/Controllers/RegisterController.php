<?php

declare(strict_types=1);

namespace App\Features\Registration\Http\Controllers;

use App\Features\Registration\Actions\RegisterUser;
use App\Features\Registration\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function store(RegisterRequest $request, RegisterUser $registerUser)
    {
        try {
            $data = $request->validated();

            $accessLink = DB::transaction(function () use ($registerUser, $data) {
                return $registerUser->handle($data['username'], $data['phone_number']);
            }, 3);

            return redirect()->to($accessLink->url());

        } catch (\Throwable $e) {
            report($e);

            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred during registration. Please try again.']);
        }
    }
}
