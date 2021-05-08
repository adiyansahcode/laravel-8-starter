<x-layouts.base :title="__('Reset Password')">
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
      <a href="{{ url('/') }}">
        <x-layouts.application-logo class="w-20 h-20 fill-current text-gray-700" />
      </a>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
      <h2 class="text-center font-semibold text-2xl text-gray-700 mb-5">
        {{ $component->title }}
      </h2>

      <x-alert type="success" class="mb-4 font-medium text-sm text-green-600" />
      <x-alert type="error" class="mb-4 font-medium text-sm text-red-600" />

      <x-form action="{{ route('password.update') }}" novalidate autocomplete="off">
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
          <x-label for="email" class="block font-medium text-sm text-gray-700" />
          @php
            $borderColor = $errors->has('email') ? 'border-red-300 focus:border-red-300 focus:ring-red-300' : 'border-gray-300 focus:border-gray-300 focus:ring-gray-300';
          @endphp
          <x-input id="email" name="email" required readonly :value="old('email', $request->email)"
          class="mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-opacity-50 {{ $borderColor }}" />
          <x-error field="email" class="mt-1 font-medium text-sm text-red-600" />
        </div>

        <div class="mt-4">
          <x-label for="password" class="block font-medium text-sm text-gray-700" />
          @php
            $borderColor = $errors->has('password') ? 'border-red-300 focus:border-red-300 focus:ring-red-300' : 'border-gray-300 focus:border-gray-300 focus:ring-gray-300';
          @endphp
          <x-form.password-show id="password" name="password"
          class="mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-opacity-50 {{ $borderColor }}" />
          <x-error field="password" class="mt-1 font-medium text-sm text-red-600" />
        </div>

        <div class="mt-4">
          <x-label for="password_confirmation" class="block font-medium text-sm text-gray-700" />
          @php
            $borderColor = $errors->has('password_confirmation') ? 'border-red-300 focus:border-red-300 focus:ring-red-300' : 'border-gray-300 focus:border-gray-300 focus:ring-gray-300';
          @endphp
          <x-form.password-show id="password_confirmation" name="password_confirmation"
          class="mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-opacity-50 {{ $borderColor }}" />
          <x-error field="password_confirmation" class="mt-1 font-medium text-sm text-red-600" />
        </div>

        <div class="block mt-6">
          <button type="submit"
            class="w-full px-2 py-2 items-center bg-gray-800 border border-transparent rounded-md font-medium text-base text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 flex-auto">
            Reset
          </button>
        </div>
      </x-form>

    </div>
  </div>
</x-layouts.base>
