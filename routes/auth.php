<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\AuthTwoFactorController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware(['guest', 'authTwoFactor']);

Route::get('/otp/verify', [AuthTwoFactorController::class, 'create'])
                ->middleware(['auth', 'authTwoFactor'])
                ->name('otp.verify');

Route::post('/otp/verify', [AuthTwoFactorController::class, 'store'])
                ->middleware(['auth', 'authTwoFactor']);

Route::get('/otp/resend', [AuthTwoFactorController::class, 'resend'])
                ->middleware(['auth'])
                ->name('otp.resend');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');

Route::get('/profile', [ProfileController::class, '__invoke'])
                ->middleware('auth')
                ->name('profile');

Route::get('/setting/profile', [SettingController::class, 'profile'])
                ->middleware(['auth', 'password.confirm'])
                ->name('setting.profile');

Route::put('/setting/profile', [SettingController::class, 'profileUpdate'])
                ->middleware('auth');

Route::get('/setting/security', [SettingController::class, 'security'])
                ->middleware(['auth', 'password.confirm'])
                ->name('setting.security');

Route::put('/setting/security', [SettingController::class, 'securityUpdate'])
                ->middleware(['auth']);

Route::get('/log', [ProfileController::class, 'log'])
                ->middleware('auth')
                ->name('log');
