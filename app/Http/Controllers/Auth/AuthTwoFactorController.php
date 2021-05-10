<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthTwoFactorRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AuthTwoFactorController extends Controller
{
    /**
     * Display the auth two factor view.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('auth.twoFactor');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\AuthTwoFactorRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AuthTwoFactorRequest $request): RedirectResponse
    {
        $request->codeValidate();

        $auth = Auth::user();
        $auth->resetTwoFactorCode();
        return redirect()->route('dashboard');
    }

    /**
     * resend two factor code authentication.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resend(): RedirectResponse
    {
        $auth = \Auth::user();
        $auth->sendTwoFactorCodeNotification();

        return redirect()->back()->with('success', 'The two factor code has been sent again');
    }
}
