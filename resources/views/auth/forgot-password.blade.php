<x-layouts.base :title="__('Reset your password')">
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

      <x-form action="{{ route('password.email') }}" novalidate autocomplete="off">
        <fieldset>
          <div>
            <p class="text-sm text-gray-500">
              Enter your user account's verified email address and we will send you a password reset link.
            </p>
          </div>
          <div class="mt-4">
            @php
              $borderColor = $errors->has('email') ? 'border-red-300 focus:border-red-300 focus:ring-red-300' : 'border-gray-300 focus:border-gray-300 focus:ring-gray-300';
            @endphp
            <x-email id="email" name="email" placeholder="Email" autofocus required
            class="block mt-1 w-full rounded-md shadow-sm focus:ring focus:ring-opacity-50 {{ $borderColor }}" />
            <x-error field="email" class="mt-4 font-medium text-sm text-red-600" />
          </div>
        </fieldset>

        <div class="py-5">
          <a href="{{ route('login') }}"
            class="items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-gray-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
            Sign in
          </a>

          <button type="submit"
            class="items-center justify-center float-right px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            Send Password Reset Link
          </button>
        </div>
      </x-form>
    </div>
  </div>
</x-layouts.base>
