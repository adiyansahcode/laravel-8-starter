<x-layouts.app :title="__('Dashboard')">

  @if (session('status') === 'verification-link-sent')
  <div class="mb-4 font-medium text-sm text-green-600">
    A new verification link has been sent to the email address you provided during registration.
  </div>
  @endif

  @if (!Auth::user()->hasVerifiedEmail())
  <div class="max-w-7xl py-5 px-5 mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="py-3 px-3 flex items-center justify-between flex-wrap">
        <div class="w-0 flex-1 flex items-center">
          <span class="flex p-2 rounded-lg bg-gray-800">
            <x-heroicon-o-mail class="h-6 w-6 text-white" />
          </span>
          <p class="ml-3 font-medium truncate">
            <span class="inline capitalize text-gray-700">
              Please verify your email address
            </span>
          </p>
        </div>
        <div class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
          <x-form-button :action="route('verification.send')"
            class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-700 hover:bg-gray-500 transition duration-150 ease-in-out">
            Resend Email
          </x-form-button>
        </div>
        <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-3">
          <button type="button"
            class="-mr-1 flex p-2 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-100 sm:-mr-2 transition duration-150 ease-in-out">
            <span class="sr-only">Dismiss</span>
            <x-heroicon-o-x class="h-6 w-6 text-gray-700" />
          </button>
        </div>
      </div>
    </div>
  </div>
  @endif

  <div class="max-w-7xl py-5 mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 bg-white border-gray-200">
        You're logged in!
      </div>
    </div>
  </div>

</x-layouts.app>
