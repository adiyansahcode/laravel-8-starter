<x-layouts.app :title="__('Security Setting')">
  <div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 md:px-6 lg:px-8 xl:px-8">
      <div class="shadow-md overflow-hidden sm:rounded-md">

        <x-form method="PUT" action="{{ route('setting.security') }}">
          <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
            <fieldset>
              <div>
                <legend class="text-base font-medium text-gray-900">Two-factor Authentication</legend>
                <p class="text-sm text-gray-500">Two-factor authentication adds an additional layer of security to your
                  account by requiring more than just a password to log in.</p>
              </div>
              <div class="mt-4 space-y-4">
                <div class="flex items-center">
                  <input type="radio" id="disable" name="twoFactor" value="0"
                    {{ ($isChecked === 0)? "checked" : "" }}>
                  <x-label for="disable" class="ml-2 text-sm text-gray-700" />
                </div>

                @foreach ($twoFactor as $twoFactorData)
                <div class="flex items-center">
                  <input type="radio" id="{{ $twoFactorData->name }}" name="twoFactor" value="{{ $twoFactorData->id }}"
                    {{ ($isChecked === $twoFactorData->id)? "checked" : "" }}>
                  <x-label for="{{ $twoFactorData->name }}" class="ml-2 text-sm text-gray-700" />
                </div>
                @endforeach
              </div>
            </fieldset>
          </div>

          <div class="px-4 py-5 bg-gray-50 sm:p-6">
            <a href="{{ route('profile') }}"
              class="items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-gray-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
              Back
            </a>

            <button type="submit"
              class="items-center justify-center float-right px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
              Update
            </button>
          </div>
        </x-form>
      </div>
    </div>
  </div>
</x-layouts.app>
