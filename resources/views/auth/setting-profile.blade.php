<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('setting.profile') }}">
                    @method('PUT')
                    @csrf

                    <!-- Fullname -->
                    <div>
                        <x-label for="fullname" :value="__('Fullname')" />

                        <x-input id="fullname" class="block mt-1 w-full" type="text" name="fullname" :value="old('fullname', Auth::user()->fullname)" required autofocus />
                    </div>

                    <!-- Username -->
                    <div class="mt-4">
                        <x-label for="username" :value="__('Username')" />

                        <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username', Auth::user()->username)" required />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')" />

                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', Auth::user()->email)" required />
                    </div>

                    <!-- Phone Number -->
                    <div class="mt-4">
                        <x-label for="phone" :value="__('Phone Number')" />

                        <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', Auth::user()->phone)" required />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
