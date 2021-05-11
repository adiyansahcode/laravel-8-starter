<x-layouts.app :title="__('Profile')">
  <div class="py-5">
    <div class="max-w-7xl sm:max-w-md mx-auto sm:px-6 md:px-6 lg:px-8 xl:px-8">
      <div class="shadow-md overflow-hidden sm:rounded-md bg-white">

        @if (Session::has('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
          {{ session("status") }}
        </div>
        @endif

        <div class="text-center p-6 border-b">
          <img class="h-36 w-36 rounded-full mx-auto" alt="profile" src="{{ Auth::user()->getImage() }}" />
          <p class="pt-2 text-lg font-semibold">{{ Auth::user()->fullname }}</p>
          <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
          <p class="text-sm text-gray-600">{{ Auth::user()->phone }}</p>
        </div>

        <div class="border-b">
          <a href="{{ route('setting.profile') }}" class="px-4 py-2 hover:bg-gray-100 flex">
            <div class="text-gray-500 flex flex-wrap content-center">
              <x-heroicon-o-user-circle class="w-6 h-6" />
            </div>
            <div class="pl-3">
              <p class="text-sm font-medium text-gray-800 leading-none">
                Account
              </p>
              <p class="text-xs text-gray-500">Profile, Email, Phone</p>
            </div>
          </a>
          <a href="{{ route('setting.security') }}" class="px-4 py-2 hover:bg-gray-100 flex">
            <div class="text-gray-500 flex flex-wrap content-center">
              <x-heroicon-o-cog class="w-6 h-6" />
            </div>
            <div class="pl-3">
              <p class="text-sm font-medium text-gray-800 leading-none">
                Security
              </p>
              <p class="text-xs text-gray-500">
                Password, Two-factor Authentication
              </p>
            </div>
          </a>
        </div>

        <div class="mt-3 mb-3">
          <x-logout
            class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
            Sign Out
          </x-logout>
        </div>

      </div>
    </div>
  </div>
</x-layouts.app>
