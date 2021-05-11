<x-layouts.app :title="__('Dashboard')">
  <div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          You're logged in!
        </div>
      </div>
    </div>
  </div>

  @if (!Auth::user()->hasVerifiedEmail())
  <div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="mb-4 text-sm text-gray-600">
            {{ __('Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
          </div>

          @if (session('status') == 'verification-link-sent')
          <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
          </div>
          @endif

          <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
              @csrf

              <div>
                <button type="submit"
                  class="items-center justify-center float-right px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                  Resend Verification Email
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
</x-layouts.app>
