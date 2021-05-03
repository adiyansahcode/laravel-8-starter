<x-guest-layout>
  <x-auth-card>
    <x-slot name="logo">
      <a href="/">
        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
      </a>
    </x-slot>

    <x-bui-alert type="success" class="mb-4 font-medium text-sm text-green-600" />
    <x-bui-alert type="error" class="mb-4 font-medium text-sm text-red-600" />

    <x-bui-form id="form-otp" action="{{ route('otp.verify') }}">
      <fieldset>
        <div>
          <legend class="text-base font-medium text-gray-900">Two Factor Verification</legend>
          <p class="text-sm text-gray-500">
            You have received an email which contains OTP code.
            If you haven't received it,
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('otp.resend') }}">
              Resend OTP
            </a>
          </p>
        </div>
        <div class="mt-4">
          <x-bui-input id="twoFactorCode" name="twoFactorCode" placeholder="OTP Code" autofocus required
            class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
          <x-bui-error field="twoFactorCode" class="mt-4 font-medium text-sm text-red-600" />
        </div>
      </fieldset>

      <div class="py-5">
        <a href="#" onclick="event.preventDefault(); document.getElementById('form-logout').submit();"
          class="items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-gray-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
          Log out
        </a>

        <button type="submit"
          class="items-center justify-center float-right px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
          Verify
        </button>
      </div>
    </x-bui-form>

    <form id="form-logout" method="POST" action="{{ route('logout') }}">
      @csrf
    </form>

  </x-auth-card>
</x-guest-layout>
