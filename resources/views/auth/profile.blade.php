<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                @if (Session::has('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="text-center p-6 border-b">
                    <img
                        class="h-24 w-24 rounded-full mx-auto"
                        src="{{ asset('storage/images/profile-pic-male.jpg') }}"
                        alt="profile"
                    />
                    <p class="pt-2 text-lg font-semibold">{{ Auth::user()->fullname }}</p>
                    <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
                    <p class="text-sm text-gray-600">{{ Auth::user()->phone }}</p>
                </div>
                <div class="border-b">
                    <a href="{{ route('setting.profile') }}" class="px-4 py-2 hover:bg-gray-100 flex">
                        <div class="text-gray-800 flex flex-wrap content-center">
                            <svg
                                fill="none"
                                stroke="currentColor"
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                strokeWidth="1"
                                viewBox="0 0 24 24"
                                class="w-5 h-5"
                            >
                                <path d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="pl-3">
                            <p class="text-sm font-medium text-gray-800 leading-none">Personal settings</p>
                            <p class="text-xs text-gray-500">Profile, Email, Notifications</p>
                        </div>
                    </a>
                </div>
                <div class="">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-card-link :href="route('logout')"
                            onclick="event.preventDefault();
                            this.closest('form').submit();">
                            {{ __('Log out') }}
                        </x-card-link>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
