<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AuthTwoFactorCode;

class AuthTwoFactorController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.twoFactor');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'twoFactorCode' => 'integer|required',
        ]);

        $auth = Auth::user();

        if ($request->input('twoFactorCode') === $auth->two_factor_code) {
            $auth->resetTwoFactorCode();

            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return redirect()
            ->back()
            ->withErrors([
                'twoFactorCode' => 'The two factor code you have entered does not match'
            ]);
    }

    public function resend()
    {
        $auth = Auth::user();
        $auth->sendTwoFactorCodeNotification();

        return redirect()->back()->with('success', 'The two factor code has been sent again');
    }
}
