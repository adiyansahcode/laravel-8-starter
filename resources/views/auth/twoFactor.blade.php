<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('otp.verify') }}">
            @csrf

            <fieldset>
                <div>
                    <legend class="text-base font-medium text-gray-900">Two Factor Verification</legend>
                    <p class="text-sm text-gray-500">
                        You have received an email which contains OTP code.
                        If you haven't received it, press
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('otp.resend') }}">
                            Resend OTP
                        </a>
                    </p>
                </div>
                <div class="mt-4 space-y-4">
                    <div>
                        <x-input
                            id="twoFactorCode"
                            class="block mt-1 w-full"
                            type="text"
                            name="twoFactorCode"
                            :value="old('twoFactorCode')"
                            placeholder="OTP Code"
                            required
                            autofocus
                        />
                    </div>
                </div>
            </fieldset>

            <div class="py-5">
                <x-button>
                    {{ __('Verify') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
