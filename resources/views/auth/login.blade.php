<x-guest-layout>
  <x-auth-card>

    <x-slot name="logo">
      <a href="{{ url('/') }}">
        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
      </a>
    </x-slot>

    <!-- Card Title -->
    <h2 class="text-center font-semibold text-3xl lg:text-4xl text-gray-700 mb-5">
      Login
    </h2>

    <x-bui-alert type="success" class="mb-4 font-medium text-sm text-green-600" />
    <x-bui-alert type="error" class="mb-4 font-medium text-sm text-red-600" />

    <x-bui-form action="{{ route('login') }}" novalidate autocomplete="off">

      <div>
        <x-bui-label for="username" class="block font-medium text-sm text-gray-700" />
        @error('username')
        @php
        $class = "mt-1 block w-full rounded-md border-red-300 shadow-sm focus:border-red-300 focus:ring
        focus:ring-red-300 focus:ring-opacity-50";
        @endphp
        @else
        @php
        $class = "mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-300 focus:ring
        focus:ring-gray-300 focus:ring-opacity-50";
        @endphp
        @endif
        <x-bui-input id="username" name="username" required autofocus :class="$class" />
        <x-bui-error field="username" class="mt-1 font-medium text-sm text-red-600" />
      </div>

      <!-- Password -->
      <div class="mt-4">
        <x-bui-label for="password" class="block font-medium text-sm text-gray-700" />
        @error('password')
        @php
        $class = "mt-1 block w-full rounded-md border-red-300 shadow-sm focus:border-red-300 focus:ring
        focus:ring-red-300 focus:ring-opacity-50";
        @endphp
        @else
        @php
        $class = "mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-300 focus:ring
        focus:ring-gray-300 focus:ring-opacity-50";
        @endphp
        @endif
        <x-password-show id="password" name="password" :class="$class" />
        <x-bui-error field="password" class="mt-1 font-medium text-sm text-red-600" />
      </div>

      <!-- Remember Me -->
      <div class="block mt-4">
        <x-bui-checkbox name="remember" id="remember"
          class="rounded border-gray-300 text-gray-600 shadow-sm focus:ring focus:border-gray-300 focus:ring-gray-200 focus:ring-opacity-50" />
        <x-bui-label for="remember" class="ml-2 text-sm text-gray-700" />
      </div>

      <x-bui-error field="login" class="block mt-4 text-red-500" />

      <div class="block mt-4">
        <button type="submit"
          class="w-full px-2 py-2 items-center bg-gray-800 border border-transparent rounded-md font-medium text-base text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 flex-auto">
          Login
        </button>
      </div>

      <div class="sm:flex sm:flex-wrap mt-8 sm:mb-4 text-sm text-center">
        <a href="{{ route('password.request') }}" class="flex-2 underline text-md text-gray-600 hover:text-gray-900">
          Forgot password?
        </a>

        <p class="flex-1 text-gray-500 text-md mx-4 my-1 sm:my-auto">
          or
        </p>

        <a href="{{ route('register') }}" class="flex-2 underline text-md text-gray-600 hover:text-gray-900">
          Create an Account
        </a>
      </div>
    </x-bui-form>
  </x-auth-card>
</x-guest-layout>
