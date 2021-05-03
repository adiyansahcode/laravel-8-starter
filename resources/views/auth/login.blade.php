<x-guest-layout>
  <x-auth-card>

    <x-slot name="logo">
      <a href="/">
        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
      </a>
    </x-slot>

    <x-bui-alert type="success" class="mb-4 font-medium text-sm text-green-600" />
    <x-bui-alert type="error" class="mb-4 font-medium text-sm text-red-600" />

    <x-bui-form action="{{ route('login') }}">
      <div>
        <x-bui-label for="username" class="block font-medium text-sm text-gray-700" />
        <x-bui-input id="username" name="username"
          class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
          autofocus required />
        <x-bui-error field="username" class="mt-4 font-medium text-sm text-red-600" />
      </div>

      <!-- Password -->
      <div class="mt-4">
        <x-bui-label for="password" class="block font-medium text-sm text-gray-700" />
        <x-password-show id="password" name="password"
          class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
          required />
        <x-bui-error field="password" class="mt-4 font-medium text-sm text-red-600" />
      </div>

      <!-- Remember Me -->
      <div class="block mt-4">
        <x-bui-checkbox name="remember" id="remember"
          class="rounded border-gray-300 text-gray-600 shadow-sm focus:ring focus:border-gray-300 focus:ring-gray-200 focus:ring-opacity-50" />
        <x-bui-label for="remember" class="ml-2 text-sm text-gray-700" />
      </div>

      <x-bui-error field="login" class="block mt-4 text-red-500" />

      <div class="flex content-center justify-between mt-4">
        <div class="flex-auto">
          <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
            {{ __('Register') }}
          </a>
        </div>

        @if (Route::has('password.request'))
        <div class="flex-auto">
          <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
            {{ __('Forgot your password?') }}
          </a>
        </div>
        @endif

        <x-button class="flex-auto ml-3">
          {{ __('Log in') }}
        </x-button>
      </div>

    </x-bui-form>
  </x-auth-card>
</x-guest-layout>
