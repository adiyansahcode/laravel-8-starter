<x-layouts.base :title="__('Sign in to your account')">
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
      <a href="{{ url('/') }}">
        <x-layouts.application-logo class="w-20 h-20 fill-current text-gray-700" />
      </a>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
      <h2 class="text-center font-semibold text-2xl capitalize text-gray-700 mb-5">
        {{ $component->title }}
      </h2>

      <x-alert type="success" class="mb-4 font-medium text-sm text-green-600" />
      <x-alert type="error" class="mb-4 font-medium text-sm text-red-600" />

      <x-form id="form-login" action="{{ route('login') }}" novalidate autocomplete="off">

        <div>
          <x-label for="username" class="block font-medium text-sm text-gray-700" />
          @php
            $borderColor = $errors->has('username') ? 'border-red-300 focus:border-red-300 focus:ring-red-300' : 'border-gray-300 focus:border-gray-300 focus:ring-gray-300';
          @endphp
          <x-input id="username" name="username" required autofocus
          class="mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-opacity-50 {{ $borderColor }}" />
          <x-error field="username" class="mt-1 font-medium text-sm text-red-600" />
        </div>

        <!-- Password -->
        <div class="mt-4">
          <x-label for="password" class="block font-medium text-sm text-gray-700" />
          @php
            $borderColor = $errors->has('password') ? 'border-red-300 focus:border-red-300 focus:ring-red-300' : 'border-gray-300 focus:border-gray-300 focus:ring-gray-300';
          @endphp
          <x-form.password-show id="password" name="password"
          class="mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-opacity-50 {{ $borderColor }}" />
          <x-error field="password" class="mt-1 font-medium text-sm text-red-600" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
          <x-checkbox name="remember" id="remember"
            class="rounded border-gray-300 text-gray-600 shadow-sm focus:ring focus:border-gray-300 focus:ring-gray-200 focus:ring-opacity-50" />
          <x-label for="remember" class="ml-2 text-sm text-gray-700" />
        </div>

        <x-error field="login" class="block mt-4 text-red-500" />

        <div class="block mt-4">
          <button type="submit"
            class="w-full px-2 py-2 items-center bg-gray-800 border border-transparent rounded-md font-medium text-base text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 flex-auto">
            Sign in
          </button>
        </div>

        <div class="sm:flex sm:flex-wrap mt-8 sm:mb-4 text-sm text-center">
          <a href="{{ route('password.request') }}" class="flex-2 underline text-md capitalize text-gray-600 hover:text-gray-900">
            Forgot password?
          </a>

          <p class="flex-1 text-gray-500 text-md mx-4 my-1 sm:my-auto">
            or
          </p>

          <a href="{{ route('register') }}" class="flex-2 underline text-md capitalize text-gray-600 hover:text-gray-900">
            Create your Account
          </a>
        </div>
      </x-form>
    </div>
  </div>
</x-layouts.base>
