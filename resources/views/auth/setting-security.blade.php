<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Security Setting') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 md:px-6 lg:px-8 xl:px-8">
            <div class="shadow-md overflow-hidden sm:rounded-md">

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('setting.security') }}">
                    @method('PUT')
                    @csrf

                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <fieldset>
                            <div>
                                <legend class="text-base font-medium text-gray-900">Two-factor Authentication</legend>
                                <p class="text-sm text-gray-500">Two-factor authentication adds an additional layer of security to your account by requiring more than just a password to log in.</p>
                            </div>
                            <div class="mt-4 space-y-4">
                                <x-input-radio :label="__('disable')" :id="__('disable')" name="twoFactor" value="0" :checked="__(($isChecked === 0 )? true : false)" />

                                @foreach ($twoFactor as $twoFactorData)
                                    <x-input-radio :label="__($twoFactorData->name)" :id="__($twoFactorData->name)" name="twoFactor" value="{{ $twoFactorData->id }}" :checked="__(($isChecked === $twoFactorData->id )? true : false)" />
                                @endforeach
                            </div>
                        </fieldset>
                    </div>

                    <div class="px-4 py-5 bg-gray-50">
                        <x-button-link :href="route('profile')" class="ml-1">
                            {{ __('Back') }}
                        </x-button-link>
                        <x-button class="ml-1">
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
