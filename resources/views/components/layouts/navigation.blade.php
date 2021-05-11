<nav class="bg-white shadow" x-data="{ open: false }">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <div class="flex">
        <div class="flex-shrink-0 flex items-center">
          <x-layouts.application-logo class="block h-10 w-auto fill-current text-gray-600" />
        </div>

        <div class="hidden md:block">
          <div class="ml-8 flex items-baseline space-x-5">
            <a href="{{ route('dashboard') }}"
              class="py-3 border-b-2 border-gray-500 text-sm font-medium leading-5 capitalize text-gray-900 focus:outline-none focus:border-gray-700 transition duration-150 ease-in-out">
              Dashboard
            </a>
            <a href="#"
              class="py-3 text-sm font-medium leading-5 capitalize text-gray-500 focus:outline-none focus:text-gray-700 focus:border-gray-300 hover:text-gray-700 hover:border-gray-300 transition duration-150 ease-in-out">
              Menu 1
            </a>
          </div>
        </div>
      </div>

      <div class="hidden sm:ml-6 sm:flex sm:items-center">
        <!-- Profile dropdown -->
        <x-dropdown class="ml-3 relative">
          <x-slot name="trigger">
            <button id="user-menu" aria-label="User menu" aria-haspopup="true"
              class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out" >
              <span class="sr-only">Open user menu</span>
              <img class="h-8 w-8 rounded-full" alt="profile" src="{{ Auth::user()->getImage() }}" />
            </button>
          </x-slot>

          <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
            <div class="py-1 rounded-md bg-white shadow-xs">
              <a href="{{ route('profile') }}"
                class="block text-left w-full px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                Profile
              </a>
              <x-logout
                class="block text-left w-full px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                Sign Out
              </x-logout>
            </div>
          </div>
        </x-dropdown>
      </div>
      <div class="-mr-2 flex items-center sm:hidden">
        <!-- Mobile menu button -->
        <button
          class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
          <!-- Menu open: "hidden", Menu closed: "block" -->
          <svg :class="{ 'block': ! open, 'hidden': open }" class="block h-6 w-6" stroke="currentColor" fill="none"
            viewBox="0 0 24 24" @click="open = true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <!-- Menu open: "block", Menu closed: "hidden" -->
          <svg :class="{ 'block': open, 'hidden': ! open }" class="hidden h-6 w-6" stroke="currentColor" fill="none"
            viewBox="0 0 24 24" @click="open = false">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <div class="sm:hidden" x-show="open" @click.away="open = false">
    <div class="pt-2 pb-3">
      <a href="{{ route('dashboard') }}"
        class="block pl-3 pr-4 py-2 border-l-4 border-gray-500 text-base font-medium text-gray-700 bg-gray-50 focus:outline-none focus:text-gray-800 focus:bg-gray-100 focus:border-gray-700 transition duration-150 ease-in-out">
        Dashboard
      </a>
      <a href="#"
        class="mt-1 block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
        Menu 1
      </a>
    </div>
    <div class="pt-4 pb-3 border-t border-gray-200">
      <div class="flex items-center px-4">
        <div class="flex-shrink-0">
          <img class="h-10 w-10 rounded-full" alt="profile" src="{{ Auth::user()->getImage() }}" />
        </div>
        <div class="ml-3">
          <div class="text-base font-medium leading-6 text-gray-800">{{ Auth::user()->fullname }}</div>
          <div class="text-sm font-medium leading-5 text-gray-500">{{ Auth::user()->email }}</div>
        </div>
      </div>
      <div class="mt-3" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
        <a href="{{ route('profile') }}" role="menuitem"
          class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100 transition duration-150 ease-in-out">
          Profile
        </a>
        <x-logout
          class="mt-1 block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100 transition duration-150 ease-in-out">
          Sign Out
        </x-logout>
      </div>
    </div>
  </div>
</nav>
