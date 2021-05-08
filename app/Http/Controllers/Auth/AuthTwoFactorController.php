<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\AuthTwoFactorRequest;

class AuthTwoFactorController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create(): object
    {
        return view('auth.twoFactor');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\AuthTwoFactorRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AuthTwoFactorRequest $request): object
    {
        $auth = \Auth::user();

        if ($request->input('twoFactorCode') === $auth->two_factor_code) {
            $auth->resetTwoFactorCode();

            return redirect()->route('dashboard');
        }

        return redirect()
            ->back()
            ->withErrors([
                'twoFactorCode' => 'The two factor code you have entered does not match'
            ]);
    }

    public function resend(): object
    {
        $auth = \Auth::user();
        $auth->sendTwoFactorCodeNotification();

        return redirect()->back()->with('success', 'The two factor code has been sent again');
    }
}
